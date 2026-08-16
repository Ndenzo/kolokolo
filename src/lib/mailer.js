const nodemailer = require('nodemailer');
const { smtp, defaultSettings } = require('../config');

function isConfigured() {
	return Boolean(smtp.host);
}

function fromAddress() {
	if (smtp.from) return smtp.from;
	if (smtp.user) return `Kolokolo <${smtp.user}>`;
	return `Kolokolo <noreply@kolokolo.tech>`;
}

function createTransport() {
	if (!isConfigured()) return null;
	const options = {
		host: smtp.host,
		port: smtp.port,
		secure: smtp.secure,
	};
	if (smtp.user) {
		options.auth = { user: smtp.user, pass: smtp.password };
	}
	return nodemailer.createTransport(options);
}

function escapeHtml(value) {
	return String(value || '')
		.replace(/&/g, '&amp;')
		.replace(/</g, '&lt;')
		.replace(/>/g, '&gt;')
		.replace(/"/g, '&quot;');
}

function quoteRows(request) {
	return [
		['Nom', `${request.firstname} ${request.lastname}`],
		['Email', request.email],
		['Téléphone', request.phone || '—'],
		['Entreprise', request.company || '—'],
		['Services', request.services || '—'],
		['Formule', request.offer || '—'],
		['Budget', request.budget || '—'],
		['Délai', request.timeline || '—'],
		['Attentes', request.message || '—'],
	];
}

function brandedRows(rows) {
	return rows
		.map(([label, value]) => `
			<tr>
				<td style="padding:10px 12px;border-bottom:1px solid #eceef5;color:#6b7289;width:140px;vertical-align:top;">${escapeHtml(label)}</td>
				<td style="padding:10px 12px;border-bottom:1px solid #eceef5;color:#0c0b22;white-space:pre-wrap;">${escapeHtml(value)}</td>
			</tr>`)
		.join('');
}

function brandedHtml(title, rows) {
	return `
		<div style="font-family:Roboto,Arial,sans-serif;background:#f3f4f9;padding:24px;">
			<div style="max-width:640px;margin:0 auto;background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 18px 50px rgba(12,11,34,.08);">
				<div style="background:#0c0b22;color:#fff;padding:22px 28px;">
					<p style="margin:0 0 6px;letter-spacing:.18em;text-transform:uppercase;font-size:11px;color:#F5A623;">Kolokolo</p>
					<h1 style="margin:0;font-size:22px;">${escapeHtml(title)}</h1>
				</div>
				<table style="width:100%;border-collapse:collapse;">${brandedRows(rows)}</table>
			</div>
		</div>`;
}

function brandedText(rows) {
	return rows.map(([label, value]) => `${label} : ${value}`).join('\n');
}

async function sendBrandedMail({ title, subject, rows, replyTo, fallbackTo }) {
	const transport = createTransport();
	if (!transport) {
		console.warn(`SMTP non configuré : « ${title} » enregistré sans envoi d’email.`);
		return false;
	}
	const to = smtp.to || fallbackTo || defaultSettings.email;
	if (!to) {
		console.warn('Aucun destinataire MAIL_TO / email du site : email non envoyé.');
		return false;
	}
	await transport.sendMail({
		from: fromAddress(),
		to,
		replyTo,
		subject,
		text: brandedText(rows),
		html: brandedHtml(title, rows),
	});
	return true;
}

async function sendQuoteRequest(request, fallbackTo) {
	return sendBrandedMail({
		title: 'Nouvelle demande de devis',
		subject: `Nouveau devis — ${request.firstname} ${request.lastname}`,
		replyTo: request.email,
		fallbackTo,
		rows: quoteRows(request),
	});
}

async function sendContactMessage(message, fallbackTo) {
	return sendBrandedMail({
		title: 'Nouveau message de contact',
		subject: `Contact — ${message.firstname} ${message.lastname}${message.subject ? ` (${message.subject})` : ''}`,
		replyTo: message.email,
		fallbackTo,
		rows: [
			['Nom', `${message.firstname} ${message.lastname}`],
			['Email', message.email],
			['Téléphone', message.phone || '—'],
			['Sujet', message.subject || '—'],
			['Message', message.message || '—'],
		],
	});
}

module.exports = { isConfigured, sendQuoteRequest, sendContactMessage };
