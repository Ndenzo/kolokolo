const path = require('node:path');
const ejs = require('ejs');
const { siteUrl, defaultSettings } = require('../config');
const helpers = require('./helpers');

const VIEWS = path.join(__dirname, '..', '..', 'views', 'emails');

function socialUrl(value) {
	const url = String(value || '').trim();
	if (!url || url === '#') return '';
	return url;
}

function mailContext(settings = {}) {
	const merged = { ...defaultSettings, ...settings };
	const place = merged.place || helpers.contactPlace(merged);
	const base = siteUrl;
	const icons = {
		facebook: `${base}/assets/mail/facebook.png`,
		twitter: `${base}/assets/mail/twitter.png`,
		instagram: `${base}/assets/mail/instagram.png`,
	};
	const socials = [
		{ label: 'Facebook', url: socialUrl(merged.facebook), icon: icons.facebook },
		{ label: 'X', url: socialUrl(merged.twitter), icon: icons.twitter },
		{ label: 'Instagram', url: socialUrl(merged.instagram), icon: icons.instagram },
		{ label: 'LinkedIn', url: socialUrl(merged.linkedin), icon: '' },
	].filter((item) => item.url);

	return {
		brand: 'Kolokolo',
		siteUrl: base,
		logoUrl: `${base}/assets/mail/logo.png`,
		settings: merged,
		place,
		contactEmail: merged.email || defaultSettings.email,
		phone: merged.phone || defaultSettings.phone,
		socials,
		termsUrl: `${base}/conditions-generales`,
		privacyUrl: `${base}/confidentialite`,
		helpers,
		colors: {
			red: '#FF0A08',
			ink: '#0C0B22',
			bg: '#eceff1',
			text: '#626262',
			yellow: '#F5A623',
		},
	};
}

async function renderMail(contentView, extra = {}) {
	const ctx = { ...mailContext(extra.settings), ...extra };
	ctx.content = await ejs.renderFile(path.join(VIEWS, 'contents', `${contentView}.ejs`), ctx);
	return ejs.renderFile(path.join(VIEWS, 'layout.ejs'), ctx);
}

function notificationRows(rows) {
	return (rows || []).filter((row) => row && row[0]);
}

async function renderNotificationMail(options) {
	return renderMail('notification', {
		...options,
		rows: notificationRows(options.rows),
		kind: 'notification',
	});
}

async function renderNewsletterMail(options) {
	return renderMail('newsletter', {
		...options,
		kind: 'newsletter',
		preheader: options.preheader || options.subject || 'Newsletter Kolokolo',
		title: options.title || options.subject || 'Newsletter Kolokolo',
	});
}

const sampleContact = {
	firstname: 'Aminata',
	lastname: 'Sow',
	email: 'aminata.sow@exemple.sn',
	phone: '+221 77 000 00 00',
	subject: 'Nouveau projet',
	message: 'Bonjour, nous souhaitons refondre le site de notre entreprise et clarifier notre présence digitale à Dakar.',
};

const sampleQuote = {
	firstname: 'Moussa',
	lastname: 'Diop',
	email: 'moussa.diop@exemple.sn',
	phone: '+221 76 111 22 33',
	company: 'Atelier Horizon',
	services: 'Sites vitrines, SEO & maintenance',
	offer: 'Site vitrine',
	budget: '350 000 — 650 000 F',
	timeline: 'Dans 1 à 3 mois',
	message: 'Nous voulons un site clair, un formulaire de contact et un suivi après mise en ligne.',
};

const sampleNewsletter = {
	subject: 'Actualités Kolokolo — aperçu',
	bodyHtml: '<p>Voici un exemple de newsletter : conseils, nouveautés et projets de l’agence.</p><p>Le contenu que vous rédigez dans l’admin s’affiche ici, dans le modèle standard Kolokolo.</p>',
};

module.exports = {
	mailContext,
	renderNotificationMail,
	renderNewsletterMail,
	sampleContact,
	sampleQuote,
	sampleNewsletter,
};
