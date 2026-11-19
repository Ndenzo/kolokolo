const { db } = require('../db');
const { legal, billingPhone } = require('../config');

function round2(value) {
	const n = Number(value);
	if (!Number.isFinite(n)) return 0;
	return Math.round((n + Number.EPSILON) * 100) / 100;
}

function toArray(value) {
	if (Array.isArray(value)) return value;
	if (value == null || value === '') return [];
	return [value];
}

function lineAmount(line) {
	return round2(Number(line.quantity) * Number(line.unit_price));
}

function summarize(lines, taxRate, depositPercent) {
	const ht = round2(lines.reduce((sum, line) => sum + lineAmount(line), 0));
	const rate = round2(taxRate);
	const tax = round2(ht * rate / 100);
	const ttc = round2(ht + tax);
	const percent = round2(depositPercent);
	const deposit = round2(ttc * percent / 100);
	return { ht, tax, ttc, deposit, taxRate: rate, depositPercent: percent };
}

function paidTotal(payments) {
	return round2((payments || []).reduce((sum, payment) => sum + Number(payment.amount || 0), 0));
}

function invoiceStatusFor(total, paid, cancelled) {
	if (cancelled) return 'annulee';
	const due = round2(total);
	const got = round2(paid);
	if (due <= 0 || got + 0.009 >= due) return 'payee';
	if (got > 0) return 'partielle';
	return 'emise';
}

function addDays(iso, days) {
	const date = new Date(`${iso}T00:00:00`);
	date.setDate(date.getDate() + days);
	const pad = (n) => String(n).padStart(2, '0');
	return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}`;
}

function issuerSnapshot(settings) {
	const place = (settings && settings.place) || {};
	const address = [place.address, place.regionCountry].filter(Boolean).join('\n');
	return {
		issuer_name: legal.companyName || 'Kolokolo',
		issuer_form: legal.form || '',
		issuer_address: address,
		issuer_email: (settings && settings.email) || '',
		issuer_phone: billingPhone || (settings && settings.phone) || '',
		issuer_ninea: legal.ninea || '',
		issuer_rccm: legal.rccm || '',
	};
}

function customerSnapshot(customer) {
	return {
		customer_name: customer.name || '',
		customer_contact: customer.contact_name || '',
		customer_email: customer.email || '',
		customer_phone: customer.phone || '',
		customer_address: customer.address || '',
		customer_ninea: customer.ninea || '',
	};
}

async function allocateNumber(trx, kind) {
	const row = await trx('document_sequences').where({ kind }).forUpdate().first();
	if (!row) throw new Error(`Séquence introuvable : ${kind}`);
	await trx('document_sequences').where({ kind }).update({ next_number: Number(row.next_number) + 1 });
	const prefix = kind === 'invoice' ? 'FAC' : 'DEV';
	return `${prefix}-${String(row.next_number).padStart(4, '0')}`;
}

async function refreshInvoiceStatus(invoice, total, payments) {
	const status = invoiceStatusFor(total, paidTotal(payments), invoice.cancelled_at);
	if (status !== invoice.status) {
		await db('invoices').where({ id: invoice.id }).update({ status, updated_at: db.fn.now() });
		invoice.status = status;
	}
	return invoice;
}

module.exports = {
	round2,
	toArray,
	lineAmount,
	summarize,
	paidTotal,
	invoiceStatusFor,
	addDays,
	issuerSnapshot,
	customerSnapshot,
	allocateNumber,
	refreshInvoiceStatus,
};
