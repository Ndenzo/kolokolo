const { Router } = require('express');
const { db } = require('../db');
const { requireAuth } = require('../middleware/auth');
const { setFlash } = require('../middleware/locals');
const { isoDate, normalizeEmail } = require('../lib/helpers');
const {
	PAYMENT_METHODS,
	QUOTE_STATUS,
	INVOICE_STATUS,
	EDITABLE_QUOTE_STATUS,
	DEFAULT_QUOTE_NOTES,
	methodLabel,
} = require('../data/billing');
const {
	round2,
	toArray,
	summarize,
	paidTotal,
	addDays,
	issuerSnapshot,
	customerSnapshot,
	allocateNumber,
	refreshInvoiceStatus,
} = require('../lib/billing');
const { quotePdf, invoicePdf } = require('../lib/billing-pdf');

const router = Router();
router.use(requireAuth);

function todayIso() {
	return isoDate(new Date());
}

function parseDate(value) {
	const iso = isoDate(value);
	return iso || null;
}

function parsePercent(value) {
	const n = Number(String(value ?? '').trim().replace(',', '.'));
	if (!Number.isFinite(n) || n < 0 || n > 100) return null;
	return round2(n);
}

function readLines(body) {
	const labels = toArray(body.line_label);
	const descriptions = toArray(body.line_description);
	const quantities = toArray(body.line_quantity);
	const prices = toArray(body.line_price);
	const lines = [];
	const errors = [];
	const count = Math.max(labels.length, descriptions.length, quantities.length, prices.length);
	for (let i = 0; i < count && lines.length < 40; i += 1) {
		const label = String(labels[i] || '').trim();
		const description = String(descriptions[i] || '').trim();
		const quantityRaw = String(quantities[i] || '').trim();
		const priceRaw = String(prices[i] || '').trim();
		if (!label && !description && !quantityRaw && !priceRaw) continue;
		const quantity = Number(quantityRaw.replace(',', '.'));
		const unitPrice = Number(priceRaw.replace(/\s/g, '').replace(',', '.'));
		const lineNo = lines.length + 1;
		if (!label) errors.push(`Ligne ${lineNo} : indiquez la prestation.`);
		if (!quantityRaw || !Number.isFinite(quantity) || quantity <= 0) errors.push(`Ligne ${lineNo} : la quantité doit être supérieure à 0.`);
		if (priceRaw === '' || !Number.isFinite(unitPrice) || unitPrice < 0) errors.push(`Ligne ${lineNo} : le prix unitaire est invalide.`);
		lines.push({
			position: lines.length,
			label: label.slice(0, 255),
			description,
			quantity: Number.isFinite(quantity) ? round2(quantity) : quantityRaw,
			unit_price: Number.isFinite(unitPrice) ? round2(unitPrice) : priceRaw,
		});
	}
	if (!lines.length) errors.push('Ajoutez au moins une prestation.');
	return { lines, errors };
}

function readDeposit(body) {
	const errors = [];
	const percent = parsePercent(body.deposit_percent);
	if (percent == null) errors.push("L'acompte doit être un pourcentage entre 0 et 100.");
	const paid = body.deposit_paid === '1' || body.deposit_paid === 'on';
	const paidOn = parseDate(body.deposit_paid_on);
	const method = String(body.deposit_method || '').trim();
	const reference = String(body.deposit_reference || '').trim().slice(0, 120);
	if (paid && !(percent > 0)) errors.push("Indiquez un acompte avant de le marquer comme payé.");
	if (paid && !paidOn) errors.push("Indiquez la date de paiement de l'acompte.");
	if (paid && !methodLabel(method)) errors.push("Indiquez le mode de paiement de l'acompte.");
	return {
		errors,
		deposit_percent: percent == null ? 0 : percent,
		deposit_paid: paid && percent > 0 ? 1 : 0,
		deposit_paid_on: paid && percent > 0 ? paidOn : null,
		deposit_method: paid && percent > 0 ? method : '',
		deposit_reference: paid && percent > 0 ? reference : '',
	};
}

function blankQuote(query = {}) {
	const issued = todayIso();
	return {
		id: null,
		customer_id: query.customer || '',
		quote_request_id: query.request || '',
		status: 'brouillon',
		subject: query.subject || '',
		issued_on: issued,
		valid_until: addDays(issued, 30),
		tax_rate: 0,
		deposit_percent: 0,
		deposit_paid: 0,
		deposit_paid_on: '',
		deposit_method: '',
		deposit_reference: '',
		notes: DEFAULT_QUOTE_NOTES,
	};
}

async function loadCustomers() {
	return db('customers').orderBy('name', 'asc');
}

function page(res, view, extra) {
	res.render(view, {
		layout: false,
		paymentMethods: PAYMENT_METHODS,
		billingQuoteStatus: QUOTE_STATUS,
		billingInvoiceStatus: INVOICE_STATUS,
		methodLabel,
		...extra,
	});
}

router.get('/customers', async (req, res) => {
	const customers = await db('customers').orderBy('name', 'asc');
	page(res, 'admin/billing/customers/index', {
		title: 'Clients',
		active: 'billing-customers',
		customers,
	});
});

router.get('/customers/new', (req, res) => {
	page(res, 'admin/billing/customers/form', {
		title: 'Nouveau client',
		active: 'billing-customers',
		customer: { name: '', contact_name: '', email: '', phone: '', address: '', ninea: '', notes: '' },
		action: '/admin/billing/customers',
		errors: [],
	});
});

function readCustomer(body) {
	const customer = {
		name: String(body.name || '').trim().slice(0, 180),
		contact_name: String(body.contact_name || '').trim().slice(0, 180),
		email: normalizeEmail(body.email).slice(0, 180),
		phone: String(body.phone || '').trim().slice(0, 80),
		address: String(body.address || '').trim(),
		ninea: String(body.ninea || '').trim().slice(0, 80),
		notes: String(body.notes || '').trim(),
	};
	const errors = [];
	if (!customer.name) errors.push('Le nom du client est obligatoire.');
	if (customer.email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(customer.email)) errors.push("L'email du client est invalide.");
	return { customer, errors };
}

router.post('/customers', async (req, res) => {
	const { customer, errors } = readCustomer(req.body);
	if (errors.length) {
		return page(res.status(422), 'admin/billing/customers/form', {
			title: 'Nouveau client',
			active: 'billing-customers',
			customer,
			action: '/admin/billing/customers',
			errors,
		});
	}
	const inserted = await db('customers').insert({ ...customer, created_at: db.fn.now(), updated_at: db.fn.now() });
	const id = Array.isArray(inserted) ? inserted[0] : inserted;
	setFlash(req, 'success', 'Client enregistré.');
	return res.redirect(`/admin/billing/customers/${id}`);
});

router.get('/customers/:id', async (req, res) => {
	const customer = await db('customers').where({ id: req.params.id }).first();
	if (!customer) return res.redirect('/admin/billing/customers');
	const [quotes, invoices] = await Promise.all([
		db('quotes').where({ customer_id: customer.id }).orderBy('issued_on', 'desc'),
		db('invoices').where({ customer_id: customer.id }).orderBy('issued_on', 'desc'),
	]);
	page(res, 'admin/billing/customers/show', {
		title: customer.name,
		active: 'billing-customers',
		customer,
		quotes,
		invoices,
	});
});

router.get('/customers/:id/edit', async (req, res) => {
	const customer = await db('customers').where({ id: req.params.id }).first();
	if (!customer) return res.redirect('/admin/billing/customers');
	page(res, 'admin/billing/customers/form', {
		title: 'Modifier le client',
		active: 'billing-customers',
		customer,
		action: `/admin/billing/customers/${customer.id}`,
		errors: [],
	});
});

router.post('/customers/:id', async (req, res) => {
	const existing = await db('customers').where({ id: req.params.id }).first();
	if (!existing) return res.redirect('/admin/billing/customers');
	const { customer, errors } = readCustomer(req.body);
	if (errors.length) {
		return page(res.status(422), 'admin/billing/customers/form', {
			title: 'Modifier le client',
			active: 'billing-customers',
			customer: { ...existing, ...customer },
			action: `/admin/billing/customers/${existing.id}`,
			errors,
		});
	}
	await db('customers').where({ id: existing.id }).update({ ...customer, updated_at: db.fn.now() });
	setFlash(req, 'success', 'Client mis à jour.');
	return res.redirect(`/admin/billing/customers/${existing.id}`);
});

router.post('/customers/:id/delete', async (req, res) => {
	const customer = await db('customers').where({ id: req.params.id }).first();
	if (!customer) return res.redirect('/admin/billing/customers');
	const used = await db('quotes').where({ customer_id: customer.id }).first();
	if (used) {
		setFlash(req, 'error', 'Ce client a déjà des devis. Supprimez-les avant de retirer la fiche.');
		return res.redirect(`/admin/billing/customers/${customer.id}`);
	}
	await db('customers').where({ id: customer.id }).del();
	setFlash(req, 'success', 'Client supprimé.');
	return res.redirect('/admin/billing/customers');
});

async function quoteForm(res, quote, lines, errors, status) {
	const customers = await loadCustomers();
	return page(status ? res.status(status) : res, 'admin/billing/quotes/form', {
		title: quote.id ? `Devis ${quote.number}` : 'Nouveau devis',
		active: 'billing-quotes',
		quote,
		lines: lines.length ? lines : [{ label: '', description: '', quantity: 1, unit_price: '' }],
		customers,
		errors: errors || [],
		locked: quote.status === 'facture',
	});
}

router.get('/quotes', async (req, res) => {
	const quotes = await db('quotes').orderBy('issued_on', 'desc').orderBy('id', 'desc');
	const ids = quotes.map((item) => item.id);
	const lines = ids.length ? await db('quote_lines').whereIn('quote_id', ids) : [];
	const withTotals = quotes.map((quote) => {
		const own = lines.filter((line) => line.quote_id === quote.id);
		return { ...quote, totals: summarize(own, quote.tax_rate, quote.deposit_percent) };
	});
	page(res, 'admin/billing/quotes/index', {
		title: 'Devis',
		active: 'billing-quotes',
		quotes: withTotals,
	});
});

router.post('/quotes/from-request/:requestId', async (req, res) => {
	const request = await db('quote_requests').where({ id: req.params.requestId }).first();
	if (!request) {
		setFlash(req, 'error', 'Demande introuvable.');
		return res.redirect('/admin/quotes');
	}
	const email = normalizeEmail(request.email);
	let customer = email ? await db('customers').whereRaw('lower(email) = ?', [email]).first() : null;
	if (!customer) {
		const name = String(request.company || '').trim() || `${request.firstname || ''} ${request.lastname || ''}`.trim();
		const inserted = await db('customers').insert({
			name: name.slice(0, 180) || 'Client',
			contact_name: `${request.firstname || ''} ${request.lastname || ''}`.trim().slice(0, 180),
			email,
			phone: String(request.phone || '').trim().slice(0, 80),
			address: '',
			ninea: '',
			notes: '',
			created_at: db.fn.now(),
			updated_at: db.fn.now(),
		});
		customer = { id: Array.isArray(inserted) ? inserted[0] : inserted };
	}
	const params = new URLSearchParams({
		customer: String(customer.id),
		request: String(request.id),
		subject: String(request.services || '').slice(0, 255),
	});
	setFlash(req, 'success', 'Client rattaché. Complétez les prestations du devis.');
	return res.redirect(`/admin/billing/quotes/new?${params.toString()}`);
});

router.get('/quotes/new', async (req, res) => {
	const quote = blankQuote({
		customer: req.query.customer,
		request: req.query.request,
		subject: req.query.subject,
	});
	let lines = [];
	if (req.query.request) {
		const request = await db('quote_requests').where({ id: req.query.request }).first();
		if (request) {
			const parts = String(request.services || '').split(',').map((part) => part.trim()).filter(Boolean);
			lines = (parts.length ? parts : ['']).map((label) => ({ label, description: '', quantity: 1, unit_price: '' }));
			if (request.message) quote.notes = `${DEFAULT_QUOTE_NOTES}\n\nDemande du client :\n${request.message}`;
		}
	}
	return quoteForm(res, quote, lines);
});

function readQuote(body, fallbackStatus) {
	const errors = [];
	const customerId = Number(body.customer_id);
	if (!Number.isInteger(customerId) || customerId <= 0) errors.push('Rattachez le devis à un client.');
	const subject = String(body.subject || '').trim().slice(0, 255);
	if (!subject) errors.push("L'objet de la prestation est obligatoire.");
	const issuedOn = parseDate(body.issued_on);
	const validUntil = parseDate(body.valid_until);
	if (!issuedOn) errors.push("La date d'émission est invalide.");
	if (!validUntil) errors.push('La date de validité est invalide.');
	if (issuedOn && validUntil && validUntil < issuedOn) errors.push("La validité ne peut pas précéder l'émission.");
	const taxRate = parsePercent(body.tax_rate);
	if (taxRate == null) errors.push('Le taux de TVA doit être compris entre 0 et 100.');
	const status = EDITABLE_QUOTE_STATUS.includes(body.status) ? body.status : (fallbackStatus || 'brouillon');
	const deposit = readDeposit(body);
	const parsed = readLines(body);
	errors.push(...deposit.errors, ...parsed.errors);
	const requestId = Number(body.quote_request_id);
	return {
		errors,
		lines: parsed.lines,
		data: {
			customer_id: customerId,
			quote_request_id: Number.isInteger(requestId) && requestId > 0 ? requestId : null,
			status,
			subject,
			issued_on: issuedOn,
			valid_until: validUntil,
			tax_rate: taxRate == null ? 0 : taxRate,
			notes: String(body.notes || '').trim(),
			deposit_percent: deposit.deposit_percent,
			deposit_paid: deposit.deposit_paid,
			deposit_paid_on: deposit.deposit_paid_on,
			deposit_method: deposit.deposit_method,
			deposit_reference: deposit.deposit_reference,
		},
	};
}

async function saveQuote(settings, body, existing) {
	const parsed = readQuote(body, existing && existing.status);
	if (parsed.errors.length) return parsed;
	const customer = await db('customers').where({ id: parsed.data.customer_id }).first();
	if (!customer) {
		parsed.errors.push('Le client sélectionné est introuvable.');
		return parsed;
	}
	if (parsed.data.quote_request_id) {
		const request = await db('quote_requests').where({ id: parsed.data.quote_request_id }).first();
		if (!request) parsed.data.quote_request_id = null;
	}
	const payload = {
		...parsed.data,
		...issuerSnapshot(settings),
		...customerSnapshot(customer),
		updated_at: db.fn.now(),
	};
	const lines = parsed.lines.map((line, index) => ({
		position: index,
		label: line.label,
		description: line.description,
		quantity: line.quantity,
		unit_price: line.unit_price,
	}));
	let id = existing && existing.id;
	await db.transaction(async (trx) => {
		if (!existing) {
			const number = await allocateNumber(trx, 'quote');
			const inserted = await trx('quotes').insert({ ...payload, number, created_at: db.fn.now() });
			id = Array.isArray(inserted) ? inserted[0] : inserted;
		} else {
			await trx('quotes').where({ id: existing.id }).update(payload);
			await trx('quote_lines').where({ quote_id: existing.id }).del();
		}
		await trx('quote_lines').insert(lines.map((line) => ({ ...line, quote_id: id })));
	});
	return { errors: [], id };
}

router.post('/quotes', async (req, res) => {
	const customers = await loadCustomers();
	if (!customers.length) {
		setFlash(req, 'error', 'Créez d’abord un client.');
		return res.redirect('/admin/billing/customers/new');
	}
	try {
		const saved = await saveQuote(res.locals.settings, req.body, null);
		if (saved.errors.length) {
			return quoteForm(res, { ...blankQuote(), ...saved.data, id: null }, saved.lines, saved.errors, 422);
		}
		setFlash(req, 'success', 'Devis enregistré.');
		return res.redirect(`/admin/billing/quotes/${saved.id}`);
	} catch (err) {
		console.error(err);
		setFlash(req, 'error', 'Impossible d’enregistrer le devis.');
		return res.redirect('/admin/billing/quotes/new');
	}
});

router.get('/quotes/:id', async (req, res) => {
	const quote = await db('quotes').where({ id: req.params.id }).first();
	if (!quote) return res.redirect('/admin/billing/quotes');
	const lines = await db('quote_lines').where({ quote_id: quote.id }).orderBy('position', 'asc');
	const invoice = await db('invoices').where({ quote_id: quote.id }).first();
	page(res, 'admin/billing/quotes/show', {
		title: quote.number,
		active: 'billing-quotes',
		quote,
		lines,
		totals: summarize(lines, quote.tax_rate, quote.deposit_percent),
		invoice,
	});
});

router.get('/quotes/:id/edit', async (req, res) => {
	const quote = await db('quotes').where({ id: req.params.id }).first();
	if (!quote) return res.redirect('/admin/billing/quotes');
	if (quote.status === 'facture') {
		setFlash(req, 'error', 'Ce devis a été transformé en facture. Il n’est plus modifiable.');
		return res.redirect(`/admin/billing/quotes/${quote.id}`);
	}
	const lines = await db('quote_lines').where({ quote_id: quote.id }).orderBy('position', 'asc');
	quote.issued_on = isoDate(quote.issued_on);
	quote.valid_until = isoDate(quote.valid_until);
	quote.deposit_paid_on = isoDate(quote.deposit_paid_on);
	return quoteForm(res, quote, lines);
});

router.get('/quotes/:id/pdf', async (req, res, next) => {
	try {
		const quote = await db('quotes').where({ id: req.params.id }).first();
		if (!quote) return res.redirect('/admin/billing/quotes');
		const lines = await db('quote_lines').where({ quote_id: quote.id }).orderBy('position', 'asc');
		const file = await quotePdf(quote, lines);
		res.setHeader('Content-Type', 'application/pdf');
		res.setHeader('Cache-Control', 'no-store');
		res.setHeader('Content-Disposition', `inline; filename="${quote.number}.pdf"`);
		return res.send(file);
	} catch (err) {
		return next(err);
	}
});

router.post('/quotes/:id', async (req, res) => {
	const existing = await db('quotes').where({ id: req.params.id }).first();
	if (!existing) return res.redirect('/admin/billing/quotes');
	if (existing.status === 'facture') {
		setFlash(req, 'error', 'Ce devis a été transformé en facture.');
		return res.redirect(`/admin/billing/quotes/${existing.id}`);
	}
	try {
		const saved = await saveQuote(res.locals.settings, req.body, existing);
		if (saved.errors.length) {
			return quoteForm(res, { ...existing, ...saved.data, number: existing.number }, saved.lines, saved.errors, 422);
		}
		setFlash(req, 'success', 'Devis mis à jour.');
		return res.redirect(`/admin/billing/quotes/${existing.id}`);
	} catch (err) {
		console.error(err);
		setFlash(req, 'error', 'Impossible de mettre à jour le devis.');
		return res.redirect(`/admin/billing/quotes/${existing.id}/edit`);
	}
});

router.post('/quotes/:id/status', async (req, res) => {
	const quote = await db('quotes').where({ id: req.params.id }).first();
	if (!quote) return res.redirect('/admin/billing/quotes');
	if (quote.status === 'facture') return res.redirect(`/admin/billing/quotes/${quote.id}`);
	const status = String(req.body.status || '');
	if (!EDITABLE_QUOTE_STATUS.includes(status)) {
		setFlash(req, 'error', 'Statut invalide.');
		return res.redirect(`/admin/billing/quotes/${quote.id}`);
	}
	await db('quotes').where({ id: quote.id }).update({ status, updated_at: db.fn.now() });
	setFlash(req, 'success', 'Statut du devis mis à jour.');
	return res.redirect(`/admin/billing/quotes/${quote.id}`);
});

router.post('/quotes/:id/deposit', async (req, res) => {
	const quote = await db('quotes').where({ id: req.params.id }).first();
	if (!quote) return res.redirect('/admin/billing/quotes');
	if (quote.status === 'facture') {
		setFlash(req, 'error', 'L’acompte se gère désormais dans les règlements de la facture.');
		return res.redirect(`/admin/billing/quotes/${quote.id}`);
	}
	const deposit = readDeposit({ ...req.body, deposit_percent: quote.deposit_percent });
	if (deposit.errors.length) {
		setFlash(req, 'error', deposit.errors[0]);
		return res.redirect(`/admin/billing/quotes/${quote.id}`);
	}
	await db('quotes').where({ id: quote.id }).update({
		deposit_paid: deposit.deposit_paid,
		deposit_paid_on: deposit.deposit_paid_on,
		deposit_method: deposit.deposit_method,
		deposit_reference: deposit.deposit_reference,
		updated_at: db.fn.now(),
	});
	setFlash(req, 'success', deposit.deposit_paid ? 'Acompte marqué comme payé.' : 'Acompte marqué comme non payé.');
	return res.redirect(`/admin/billing/quotes/${quote.id}`);
});

router.post('/quotes/:id/invoice', async (req, res) => {
	const quote = await db('quotes').where({ id: req.params.id }).first();
	if (!quote) return res.redirect('/admin/billing/quotes');
	if (quote.status === 'refuse' || quote.status === 'expire') {
		setFlash(req, 'error', 'Un devis refusé ou expiré ne peut pas devenir une facture.');
		return res.redirect(`/admin/billing/quotes/${quote.id}`);
	}
	const existing = await db('invoices').where({ quote_id: quote.id }).first();
	if (existing) return res.redirect(`/admin/billing/invoices/${existing.id}`);
	const lines = await db('quote_lines').where({ quote_id: quote.id }).orderBy('position', 'asc');
	const totals = summarize(lines, quote.tax_rate, quote.deposit_percent);
	if (!lines.length || totals.ttc <= 0) {
		setFlash(req, 'error', 'Ajoutez des prestations avec un montant avant de facturer.');
		return res.redirect(`/admin/billing/quotes/${quote.id}`);
	}
	const issued = todayIso();
	let invoiceId;
	await db.transaction(async (trx) => {
		const number = await allocateNumber(trx, 'invoice');
		const inserted = await trx('invoices').insert({
			number,
			quote_id: quote.id,
			customer_id: quote.customer_id,
			status: 'emise',
			issued_on: issued,
			due_on: addDays(issued, 15),
			tax_rate: quote.tax_rate,
			notes: quote.notes,
			issuer_name: quote.issuer_name,
			issuer_form: quote.issuer_form,
			issuer_address: quote.issuer_address,
			issuer_email: quote.issuer_email,
			issuer_phone: quote.issuer_phone,
			issuer_ninea: quote.issuer_ninea,
			issuer_rccm: quote.issuer_rccm,
			customer_name: quote.customer_name,
			customer_contact: quote.customer_contact,
			customer_email: quote.customer_email,
			customer_phone: quote.customer_phone,
			customer_address: quote.customer_address,
			customer_ninea: quote.customer_ninea,
			created_at: db.fn.now(),
			updated_at: db.fn.now(),
		});
		invoiceId = Array.isArray(inserted) ? inserted[0] : inserted;
		await trx('invoice_lines').insert(lines.map((line) => ({
			invoice_id: invoiceId,
			position: line.position,
			label: line.label,
			description: line.description,
			quantity: line.quantity,
			unit_price: line.unit_price,
		})));
		if (quote.deposit_paid && totals.deposit > 0) {
			await trx('payments').insert({
				invoice_id: invoiceId,
				kind: 'acompte',
				amount: totals.deposit,
				paid_on: isoDate(quote.deposit_paid_on) || issued,
				method: quote.deposit_method || 'virement',
				reference: quote.deposit_reference || '',
				note: `Acompte du devis ${quote.number}`,
				created_at: db.fn.now(),
				updated_at: db.fn.now(),
			});
		}
		const status = quote.deposit_paid && totals.deposit > 0 && totals.deposit + 0.009 >= totals.ttc ? 'payee' : (quote.deposit_paid && totals.deposit > 0 ? 'partielle' : 'emise');
		await trx('invoices').where({ id: invoiceId }).update({ status });
		await trx('quotes').where({ id: quote.id }).update({ status: 'facture', updated_at: db.fn.now() });
	});
	setFlash(req, 'success', 'Facture créée à partir du devis.');
	return res.redirect(`/admin/billing/invoices/${invoiceId}`);
});

router.post('/quotes/:id/delete', async (req, res) => {
	const quote = await db('quotes').where({ id: req.params.id }).first();
	if (!quote) return res.redirect('/admin/billing/quotes');
	const invoice = await db('invoices').where({ quote_id: quote.id }).first();
	if (invoice || quote.status === 'facture') {
		setFlash(req, 'error', 'Ce devis est lié à une facture. Il ne peut pas être supprimé.');
		return res.redirect(`/admin/billing/quotes/${quote.id}`);
	}
	await db('quotes').where({ id: quote.id }).del();
	setFlash(req, 'success', 'Devis supprimé.');
	return res.redirect('/admin/billing/quotes');
});

async function loadInvoice(id) {
	const invoice = await db('invoices').where({ id }).first();
	if (!invoice) return null;
	const [lines, payments, quote] = await Promise.all([
		db('invoice_lines').where({ invoice_id: invoice.id }).orderBy('position', 'asc'),
		db('payments').where({ invoice_id: invoice.id }).orderBy('paid_on', 'asc').orderBy('id', 'asc'),
		db('quotes').where({ id: invoice.quote_id }).first(),
	]);
	const totals = summarize(lines, invoice.tax_rate, 0);
	await refreshInvoiceStatus(invoice, totals.ttc, payments);
	return {
		invoice,
		lines,
		payments,
		quote,
		totals,
		paid: paidTotal(payments),
		remaining: Math.max(0, round2(totals.ttc - paidTotal(payments))),
	};
}

router.get('/invoices', async (req, res) => {
	const invoices = await db('invoices').orderBy('issued_on', 'desc').orderBy('id', 'desc');
	const ids = invoices.map((item) => item.id);
	const [lines, payments] = await Promise.all([
		ids.length ? db('invoice_lines').whereIn('invoice_id', ids) : [],
		ids.length ? db('payments').whereIn('invoice_id', ids) : [],
	]);
	const rows = [];
	for (const invoice of invoices) {
		const ownLines = lines.filter((line) => line.invoice_id === invoice.id);
		const ownPayments = payments.filter((payment) => payment.invoice_id === invoice.id);
		const totals = summarize(ownLines, invoice.tax_rate, 0);
		await refreshInvoiceStatus(invoice, totals.ttc, ownPayments);
		const paid = paidTotal(ownPayments);
		rows.push({ ...invoice, totals, paid, remaining: Math.max(0, round2(totals.ttc - paid)) });
	}
	page(res, 'admin/billing/invoices/index', {
		title: 'Factures',
		active: 'billing-invoices',
		invoices: rows,
	});
});

router.get('/invoices/:id', async (req, res) => {
	const data = await loadInvoice(req.params.id);
	if (!data) return res.redirect('/admin/billing/invoices');
	page(res, 'admin/billing/invoices/show', {
		title: data.invoice.number,
		active: 'billing-invoices',
		...data,
		today: todayIso(),
	});
});

router.get('/invoices/:id/pdf', async (req, res, next) => {
	try {
		const data = await loadInvoice(req.params.id);
		if (!data) return res.redirect('/admin/billing/invoices');
		const file = await invoicePdf(data.invoice, data.lines, data.payments, data.quote && data.quote.number);
		res.setHeader('Content-Type', 'application/pdf');
		res.setHeader('Cache-Control', 'no-store');
		res.setHeader('Content-Disposition', `inline; filename="${data.invoice.number}.pdf"`);
		return res.send(file);
	} catch (err) {
		return next(err);
	}
});

router.post('/invoices/:id/payments', async (req, res) => {
	const data = await loadInvoice(req.params.id);
	if (!data) return res.redirect('/admin/billing/invoices');
	if (data.invoice.status === 'annulee') {
		setFlash(req, 'error', 'Une facture annulée n’accepte plus de règlement.');
		return res.redirect(`/admin/billing/invoices/${data.invoice.id}`);
	}
	const amount = round2(String(req.body.amount || '').replace(/\s/g, '').replace(',', '.'));
	const paidOn = parseDate(req.body.paid_on);
	const method = String(req.body.method || '').trim();
	const kind = req.body.kind === 'acompte' ? 'acompte' : 'reglement';
	const errors = [];
	if (!Number.isFinite(amount) || amount <= 0) errors.push('Le montant du règlement doit être supérieur à 0.');
	if (!paidOn) errors.push('La date de paiement est invalide.');
	if (!methodLabel(method)) errors.push('Choisissez un mode de paiement.');
	if (amount > data.remaining + 0.009) errors.push('Le montant dépasse le reste à payer.');
	if (errors.length) {
		setFlash(req, 'error', errors[0]);
		return res.redirect(`/admin/billing/invoices/${data.invoice.id}`);
	}
	await db('payments').insert({
		invoice_id: data.invoice.id,
		kind,
		amount,
		paid_on: paidOn,
		method,
		reference: String(req.body.reference || '').trim().slice(0, 120),
		note: String(req.body.note || '').trim().slice(0, 255),
		created_at: db.fn.now(),
		updated_at: db.fn.now(),
	});
	const payments = await db('payments').where({ invoice_id: data.invoice.id });
	await refreshInvoiceStatus(data.invoice, data.totals.ttc, payments);
	setFlash(req, 'success', data.invoice.status === 'payee' ? 'Facture soldée.' : 'Règlement enregistré.');
	return res.redirect(`/admin/billing/invoices/${data.invoice.id}`);
});

router.post('/invoices/:id/payments/:paymentId/delete', async (req, res) => {
	const payment = await db('payments').where({ id: req.params.paymentId, invoice_id: req.params.id }).first();
	if (!payment) return res.redirect(`/admin/billing/invoices/${req.params.id}`);
	const invoice = await db('invoices').where({ id: payment.invoice_id }).first();
	if (invoice && invoice.status === 'annulee') {
		setFlash(req, 'error', 'La facture est annulée.');
		return res.redirect(`/admin/billing/invoices/${invoice.id}`);
	}
	await db('payments').where({ id: payment.id }).del();
	const data = await loadInvoice(payment.invoice_id);
	setFlash(req, 'success', 'Règlement supprimé.');
	return res.redirect(`/admin/billing/invoices/${data.invoice.id}`);
});

router.post('/invoices/:id/cancel', async (req, res) => {
	const invoice = await db('invoices').where({ id: req.params.id }).first();
	if (!invoice) return res.redirect('/admin/billing/invoices');
	if (!invoice.cancelled_at) {
		await db('invoices').where({ id: invoice.id }).update({
			status: 'annulee',
			cancelled_at: db.fn.now(),
			updated_at: db.fn.now(),
		});
	}
	setFlash(req, 'success', 'Facture annulée.');
	return res.redirect(`/admin/billing/invoices/${invoice.id}`);
});

module.exports = router;
