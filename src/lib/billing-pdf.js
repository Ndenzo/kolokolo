const fs = require('node:fs');
const path = require('node:path');
const PDFDocument = require('pdfkit');
const { PNG } = require('pngjs');
const { formatMoney, formatIsoDate } = require('./helpers');
const { methodLabel } = require('../data/billing');
const { lineAmount, summarize, paidTotal } = require('./billing');
const { siteUrl, billingPhone } = require('../config');

const RED = '#FF0A08';
const INK = '#0C0B22';
const MUTED = '#626262';
const LINE = '#E7E9F2';
const SOFT = '#F6F7FB';
const WHITE = '#FFFFFF';
const LOGO_PATH = path.join(__dirname, '..', '..', 'public', 'assets', 'custom', 'img', 'logo', 'logoh.png');

let logoCache;

function logoBuffer() {
	if (logoCache) return logoCache;
	const png = PNG.sync.read(fs.readFileSync(LOGO_PATH));
	for (let i = 0; i < png.data.length; i += 4) {
		const max = Math.max(png.data[i], png.data[i + 1], png.data[i + 2]);
		const min = Math.min(png.data[i], png.data[i + 1], png.data[i + 2]);
		if (max < 42 && max - min < 14) png.data[i + 3] = 0;
	}
	logoCache = PNG.sync.write(png);
	return logoCache;
}

function pdfText(value) {
	return String(value || '')
		.replace(/\r\n/g, '\n')
		.replace(/\r/g, '\n')
		.replace(/\u2019|\u2018/g, "'")
		.replace(/\u201c|\u201d/g, '"')
		.replace(/\u2026/g, '...')
		.replace(/\u2013|\u2014/g, '-')
		.replace(/\u00a0/g, ' ');
}

function partyLines(block) {
	return [
		block.name,
		block.form,
		block.contact,
		block.address,
		block.email,
		block.phone,
		block.ninea ? `NINEA : ${block.ninea}` : '',
		block.rccm ? `RCCM : ${block.rccm}` : '',
	].flatMap((line) => pdfText(line).split('\n').map((part) => part.trim()).filter(Boolean));
}

function hostLabel() {
	return String(siteUrl || 'https://kolokolo.tech').replace(/^https?:\/\//, '').replace(/\/$/, '');
}

function drawFooter(doc, page, pages) {
	const width = doc.page.width;
	const y = doc.page.height - 36;
	doc.save();
	doc.rect(0, y, width, 36).fill(RED);
	doc.fillColor(WHITE).font('Helvetica').fontSize(8).text(
		pdfText(`Kolokolo  ·  Prestation de service  ·  ${hostLabel()}  ·  Page ${page}/${pages}`),
		36,
		y + 14,
		{ width: width - 72, align: 'center', lineBreak: false }
	);
	doc.restore();
}

function renderPdf(paint) {
	return new Promise((resolve, reject) => {
		const doc = new PDFDocument({ size: 'A4', margin: 0, bufferPages: true });
		const chunks = [];
		doc.on('data', (chunk) => chunks.push(chunk));
		doc.on('error', reject);
		doc.on('end', () => resolve(Buffer.concat(chunks)));
		try {
			paint(doc);
			const range = doc.bufferedPageRange();
			for (let i = 0; i < range.count; i += 1) {
				doc.switchToPage(range.start + i);
				drawFooter(doc, i + 1, range.count);
			}
			doc.end();
		} catch (err) {
			reject(err);
		}
	});
}

function drawHeader(doc, model) {
	const right = 330;
	const rightWidth = 229;
	doc.rect(0, 0, doc.page.width, 8).fill(RED);
	try {
		doc.image(logoBuffer(), 36, 28, { height: 36 });
	} catch (err) {
		doc.fillColor(RED).font('Helvetica-Bold').fontSize(16).text('Kolokolo', 36, 36);
	}
	doc.fillColor(RED).font('Helvetica-Bold').fontSize(22).text(model.kind === 'invoice' ? 'FACTURE' : 'DEVIS', right, 28, {
		width: rightWidth,
		align: 'right',
	});
	doc.fillColor(INK).font('Helvetica').fontSize(10).text(model.number, right, 56, { width: rightWidth, align: 'right' });
	if (model.badge) {
		doc.font('Helvetica-Bold').fontSize(8);
		const badgeWidth = Math.max(78, doc.widthOfString(model.badge) + 16);
		const badgeX = 36 + 523 - badgeWidth;
		doc.roundedRect(badgeX, 78, badgeWidth, 16, 8).fill(RED);
		doc.fillColor(WHITE).font('Helvetica-Bold').fontSize(8).text(model.badge, badgeX, 82, {
			width: badgeWidth,
			align: 'center',
			lineBreak: false,
		});
	}
	return model.badge ? 122 : 104;
}

function drawParties(doc, y, issuer, customer) {
	const boxes = [
		{ title: 'Prestataire', lines: partyLines(issuer), x: 36 },
		{ title: 'Client', lines: partyLines(customer), x: 310 },
	];
	const innerWidth = 220;
	const lineGap = 5;
	const heights = boxes.map((box) => box.lines.reduce((sum, line, index) => {
		doc.font(index === 0 ? 'Helvetica-Bold' : 'Helvetica').fontSize(9);
		return sum + doc.heightOfString(line, { width: innerWidth }) + (index < box.lines.length - 1 ? lineGap : 0);
	}, 0));
	const boxHeight = Math.max(112, 48 + Math.max(0, ...heights));
	boxes.forEach((box) => {
		doc.roundedRect(box.x, y, 249, boxHeight, 8).fill(SOFT);
		doc.fillColor(RED).font('Helvetica-Bold').fontSize(8).text(box.title.toUpperCase(), box.x + 14, y + 16, { width: innerWidth, characterSpacing: 0.6 });
		let lineY = y + 36;
		doc.fillColor(INK).fontSize(9);
		box.lines.forEach((line, index) => {
			doc.font(index === 0 ? 'Helvetica-Bold' : 'Helvetica');
			const height = doc.heightOfString(line, { width: innerWidth });
			doc.text(line, box.x + 14, lineY, { width: innerWidth });
			lineY += height + lineGap;
		});
	});
	return y + boxHeight + 26;
}

function drawMeta(doc, y, parts) {
	doc.roundedRect(36, y, 523, 28, 6).fill('#FFF1F1');
	doc.fillColor(INK).font('Helvetica').fontSize(9).text(parts.filter(Boolean).join('     '), 48, y + 9, { width: 499, lineBreak: false });
	return y + 52;
}

function drawTableHeader(doc, y) {
	doc.rect(36, y, 523, 28).fill(RED);
	doc.fillColor(WHITE).font('Helvetica-Bold').fontSize(8);
	doc.text('DÉSIGNATION', 46, y + 10, { width: 270, lineBreak: false });
	doc.text('QTÉ', 320, y + 10, { width: 40, align: 'right', lineBreak: false });
	doc.text('PRIX UNITAIRE HT', 366, y + 10, { width: 90, align: 'right', lineBreak: false });
	doc.text('MONTANT HT', 460, y + 10, { width: 88, align: 'right', lineBreak: false });
	return y + 28;
}

function rowHeight(doc, line) {
	doc.font('Helvetica').fontSize(9);
	const labelH = doc.heightOfString(pdfText(line.label), { width: 268 });
	let extra = 0;
	if (line.description) {
		doc.font('Helvetica').fontSize(8);
		extra = doc.heightOfString(pdfText(line.description), { width: 268 }) + 2;
	}
	return Math.max(40, labelH + extra + 20);
}

function drawLines(doc, y, lines) {
	let cursor = drawTableHeader(doc, y);
	lines.forEach((line, index) => {
		const height = rowHeight(doc, line);
		if (cursor + height > 760) {
			doc.addPage();
			doc.rect(0, 0, doc.page.width, 8).fill(RED);
			cursor = drawTableHeader(doc, 28);
		}
		if (index % 2 === 1) doc.rect(36, cursor, 523, height).fill(SOFT);
		doc.fillColor(INK).font('Helvetica').fontSize(9).text(pdfText(line.label), 46, cursor + 12, { width: 268 });
		if (line.description) {
			const labelH = doc.heightOfString(pdfText(line.label), { width: 268 });
			doc.fillColor(MUTED).fontSize(8).text(pdfText(line.description), 46, cursor + 14 + labelH, { width: 268 });
		}
		doc.fillColor(INK).font('Helvetica').fontSize(9);
		doc.text(String(Number(line.quantity)), 320, cursor + 12, { width: 40, align: 'right' });
		doc.text(formatMoney(line.unit_price), 360, cursor + 12, { width: 96, align: 'right' });
		doc.text(formatMoney(lineAmount(line)), 454, cursor + 12, { width: 94, align: 'right' });
		doc.moveTo(36, cursor + height).lineTo(559, cursor + height).strokeColor(LINE).lineWidth(0.5).stroke();
		cursor += height;
	});
	return cursor + 28;
}

function moneyRow(doc, y, label, value, options = {}) {
	doc.font(options.strong ? 'Helvetica-Bold' : 'Helvetica').fontSize(options.strong ? 11 : 9);
	doc.fillColor(MUTED).text(label, 330, y, { width: 110, lineBreak: false });
	doc.fillColor(options.strong ? RED : INK).text(value, 440, y, { width: 119, align: 'right', lineBreak: false });
	return y + (options.strong ? 28 : 22);
}

function drawNotes(doc, y, title, text) {
	const body = pdfText(text).trim();
	if (!body) return y;
	if (y > 700) {
		doc.addPage();
		doc.rect(0, 0, doc.page.width, 8).fill(RED);
		y = 28;
	}
	doc.fillColor(RED).font('Helvetica-Bold').fontSize(9).text(title, 36, y);
	doc.fillColor(INK).font('Helvetica').fontSize(9);
	const height = doc.heightOfString(body, { width: 523, lineGap: 3 });
	doc.text(body, 36, y + 20, { width: 523, lineGap: 3 });
	return y + 32 + height;
}

function quoteBadge(quote, totals) {
	if (quote.status === 'facture') return 'FACTURÉ';
	if (quote.status === 'accepte') return 'ACCEPTÉ';
	if (Number(totals.depositPercent) <= 0) return '';
	return quote.deposit_paid ? 'ACOMPTE PAYÉ' : 'ACOMPTE DÛ';
}

function invoiceBadge(status) {
	if (status === 'payee') return 'PAYÉE';
	if (status === 'partielle') return 'PAIEMENT PARTIEL';
	if (status === 'annulee') return 'ANNULÉE';
	return 'ÉMISE';
}

async function quotePdf(quote, lines) {
	const totals = summarize(lines, quote.tax_rate, quote.deposit_percent);
	const issuer = {
		name: quote.issuer_name,
		form: quote.issuer_form,
		address: quote.issuer_address,
		email: quote.issuer_email,
		phone: billingPhone || quote.issuer_phone,
		ninea: quote.issuer_ninea,
		rccm: quote.issuer_rccm,
	};
	const customer = {
		name: quote.customer_name,
		contact: quote.customer_contact,
		address: quote.customer_address,
		email: quote.customer_email,
		phone: quote.customer_phone,
		ninea: quote.customer_ninea,
	};
	return renderPdf((doc) => {
		let y = drawHeader(doc, { kind: 'quote', number: quote.number, badge: quoteBadge(quote, totals) });
		y = drawParties(doc, y, issuer, customer);
		y = drawMeta(doc, y, [
			`N° ${quote.number}`,
			`Émis le ${formatIsoDate(quote.issued_on)}`,
			`Valable jusqu'au ${formatIsoDate(quote.valid_until)}`,
		]);
		if (quote.subject) {
			doc.fillColor(INK).font('Helvetica-Bold').fontSize(11).text(pdfText(quote.subject), 36, y, { width: 523 });
			y += doc.heightOfString(pdfText(quote.subject), { width: 523 }) + 20;
		}
		y = drawLines(doc, y, lines);
		y = moneyRow(doc, y, 'Total HT', formatMoney(totals.ht));
		y = moneyRow(doc, y, `TVA ${totals.taxRate} %`, formatMoney(totals.tax));
		y = moneyRow(doc, y + 2, 'Total TTC', formatMoney(totals.ttc), { strong: true });
		if (totals.depositPercent > 0) {
			y += 4;
			y = moneyRow(doc, y, `Acompte ${totals.depositPercent} %`, formatMoney(totals.deposit));
			const depositLabel = quote.deposit_paid
				? `Payé le ${formatIsoDate(quote.deposit_paid_on)}${methodLabel(quote.deposit_method) ? ` · ${methodLabel(quote.deposit_method)}` : ''}`
				: 'Non payé';
			doc.fillColor(quote.deposit_paid ? '#0F7A3C' : RED).font('Helvetica').fontSize(8).text(pdfText(depositLabel), 330, y, { width: 229, align: 'right' });
			y += 16;
		}
		y = drawNotes(doc, y + 22, 'Conditions', quote.notes);
		if (y > 720) {
			doc.addPage();
			doc.rect(0, 0, doc.page.width, 8).fill(RED);
			y = 48;
		}
		doc.fillColor(INK).font('Helvetica').fontSize(9).text(
			"Bon pour accord : ______________________________     Date : ____ / ____ / ________",
			36,
			y + 28,
			{ width: 523 }
		);
	});
}

async function invoicePdf(invoice, lines, payments, quoteNumber) {
	const totals = summarize(lines, invoice.tax_rate, 0);
	const paid = paidTotal(payments);
	const remaining = Math.max(0, roundRemaining(totals.ttc, paid));
	const issuer = {
		name: invoice.issuer_name,
		form: invoice.issuer_form,
		address: invoice.issuer_address,
		email: invoice.issuer_email,
		phone: billingPhone || invoice.issuer_phone,
		ninea: invoice.issuer_ninea,
		rccm: invoice.issuer_rccm,
	};
	const customer = {
		name: invoice.customer_name,
		contact: invoice.customer_contact,
		address: invoice.customer_address,
		email: invoice.customer_email,
		phone: invoice.customer_phone,
		ninea: invoice.customer_ninea,
	};
	return renderPdf((doc) => {
		let y = drawHeader(doc, { kind: 'invoice', number: invoice.number, badge: invoiceBadge(invoice.status) });
		y = drawParties(doc, y, issuer, customer);
		y = drawMeta(doc, y, [
			`N° ${invoice.number}`,
			quoteNumber ? `Devis ${quoteNumber}` : '',
			`Émise le ${formatIsoDate(invoice.issued_on)}`,
			`Échéance ${formatIsoDate(invoice.due_on)}`,
		]);
		y = drawLines(doc, y, lines);
		y = moneyRow(doc, y, 'Total HT', formatMoney(totals.ht));
		y = moneyRow(doc, y, `TVA ${totals.taxRate} %`, formatMoney(totals.tax));
		y = moneyRow(doc, y + 2, 'Total TTC', formatMoney(totals.ttc), { strong: true });
		y += 10;
		doc.fillColor(RED).font('Helvetica-Bold').fontSize(9).text('Règlements', 36, y);
		y += 16;
		if (!payments.length) {
			doc.fillColor(MUTED).font('Helvetica').fontSize(9).text('Aucun règlement enregistré.', 36, y);
			y += 18;
		} else {
			payments.forEach((payment) => {
				if (y > 750) {
					doc.addPage();
					doc.rect(0, 0, doc.page.width, 8).fill(RED);
					y = 28;
				}
				const kind = payment.kind === 'acompte' ? 'Acompte' : 'Règlement';
				const label = `${formatIsoDate(payment.paid_on)}  ·  ${kind}  ·  ${methodLabel(payment.method) || payment.method}${payment.reference ? `  ·  ${payment.reference}` : ''}`;
				doc.fillColor(INK).font('Helvetica').fontSize(9).text(pdfText(label), 36, y, { width: 380 });
				doc.text(formatMoney(payment.amount), 420, y, { width: 139, align: 'right' });
				y += 16;
			});
		}
		y += 6;
		y = moneyRow(doc, y, 'Déjà réglé', formatMoney(paid));
		y = moneyRow(doc, y, 'Reste à payer', formatMoney(remaining), { strong: remaining > 0 });
		y = drawNotes(doc, y + 8, 'Conditions', invoice.notes);
	});
}

function roundRemaining(total, paid) {
	return Math.round((Number(total) - Number(paid) + Number.EPSILON) * 100) / 100;
}

module.exports = { quotePdf, invoicePdf };
