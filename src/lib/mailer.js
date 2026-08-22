const nodemailer = require('nodemailer');
const { smtp, defaultSettings, siteUrl } = require('../config');
const { renderNotificationMail, renderNewsletterMail } = require('./emails');

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

function mailOptions(second) {
	if (!second) return {};
	if (typeof second === 'string') return { fallbackTo: second };
	return second;
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

function contactRows(message) {
	return [
		['Nom', `${message.firstname} ${message.lastname}`],
		['Email', message.email],
		['Téléphone', message.phone || '—'],
		['Sujet', message.subject || '—'],
		['Message', message.message || '—'],
	];
}

function brandedText(rows) {
	return rows.map(([label, value]) => `${label} : ${value}`).join('\n');
}

function newsletterText(bodyHtml, unsubscribeUrl) {
	const text = String(bodyHtml || '')
		.replace(/<br\s*\/?>/gi, '\n')
		.replace(/<\/p>/gi, '\n\n')
		.replace(/<[^>]+>/g, ' ')
		.replace(/\s+\n/g, '\n')
		.replace(/\n{3,}/g, '\n\n')
		.replace(/[ \t]+/g, ' ')
		.trim();
	return `${text}\n\nSe désinscrire : ${unsubscribeUrl}`;
}

async function contactHtml(message, settings) {
	const name = `${message.firstname} ${message.lastname}`.trim();
	return renderNotificationMail({
		settings,
		title: `Contact — ${name}`,
		preheader: `Nouveau message de ${name}`,
		greetingName: 'Kolokolo',
		heading: 'Nouveau message de contact',
		intro: 'Un visiteur a envoyé un message depuis le formulaire de contact.',
		rows: contactRows(message),
		ctaLabel: 'Voir le message',
		ctaUrl: message.id ? `${siteUrl}/admin/contacts/${message.id}` : `${siteUrl}/admin/contacts`,
	});
}

async function quoteHtml(request, settings) {
	const name = `${request.firstname} ${request.lastname}`.trim();
	return renderNotificationMail({
		settings,
		title: `Nouveau devis — ${name}`,
		preheader: `Nouvelle demande de devis de ${name}`,
		greetingName: 'Kolokolo',
		heading: 'Nouvelle demande de devis',
		intro: 'Un prospect a envoyé une demande de devis depuis le site.',
		rows: quoteRows(request),
		ctaLabel: 'Voir la demande',
		ctaUrl: request.id ? `${siteUrl}/admin/quotes/${request.id}` : `${siteUrl}/admin/quotes`,
	});
}

async function sendBrandedMail({ title, subject, text, html, replyTo, fallbackTo }) {
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
		text,
		html,
	});
	return true;
}

async function sendQuoteRequest(request, second) {
	const { fallbackTo, settings } = mailOptions(second);
	return sendBrandedMail({
		title: 'Nouvelle demande de devis',
		subject: `Nouveau devis — ${request.firstname} ${request.lastname}`,
		replyTo: request.email,
		fallbackTo,
		text: brandedText(quoteRows(request)),
		html: await quoteHtml(request, settings),
	});
}

async function sendContactMessage(message, second) {
	const { fallbackTo, settings } = mailOptions(second);
	return sendBrandedMail({
		title: 'Nouveau message de contact',
		subject: `Contact — ${message.firstname} ${message.lastname}${message.subject ? ` (${message.subject})` : ''}`,
		replyTo: message.email,
		fallbackTo,
		text: brandedText(contactRows(message)),
		html: await contactHtml(message, settings),
	});
}

async function sendNewsletter({ to, subject, bodyHtml, unsubscribeUrl, settings }) {
	const transport = createTransport();
	if (!transport) return false;
	const html = await renderNewsletterMail({
		settings,
		subject,
		title: subject,
		preheader: subject,
		bodyHtml,
		unsubscribeUrl,
	});
	await transport.sendMail({
		from: fromAddress(),
		to,
		subject,
		text: newsletterText(bodyHtml, unsubscribeUrl),
		html,
		headers: {
			'List-Unsubscribe': `<${unsubscribeUrl}>`,
		},
	});
	return true;
}

module.exports = {
	isConfigured,
	sendQuoteRequest,
	sendContactMessage,
	sendNewsletter,
	contactHtml,
	quoteHtml,
};
