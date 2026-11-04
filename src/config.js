require('dotenv').config({ path: require('node:path').join(__dirname, '..', '.env') });

const DEFAULT_MAP =
	'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3838.8!2d-17.4676!3d14.6928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sDakar%2C%20Senegal!5e0!3m2!1sfr!2ssn!4v1627994034288!5m2!1sfr!2ssn';

const defaultSettings = {
	country_iso2: 'SN',
	phone: '+221 76 190 30 30',
	email: 'contact@kolokolo.tech',
	region: 'DAKAR',
	address: 'HANN MARISTES 1/B',
	location: 'DAKAR, SÉNÉGAL',
	hours: 'Lundi — Vendredi, 08:00 - 18:30',
	weekend_hours: 'Fermé',
	map_embed: DEFAULT_MAP,
	facebook: '',
	twitter: '',
	instagram: '',
	linkedin: '',
};

const smtpPort = Number(process.env.SMTP_PORT || 587);

function resolveSessionSecret() {
	const secret = String(process.env.SESSION_SECRET || '').trim();
	if (secret) return secret;
	if (process.env.NODE_ENV === 'production') {
		throw new Error('SESSION_SECRET manquant dans le .env : démarrage impossible en production.');
	}
	console.warn('[kolokolo] SESSION_SECRET absent : secret aléatoire temporaire (sessions perdues au redémarrage).');
	return require('node:crypto').randomBytes(32).toString('hex');
}

module.exports = {
	port: Number(process.env.PORT || 3000),
	siteUrl: String(process.env.SITE_URL || 'https://kolokolo.tech').replace(/\/$/, ''),
	sessionSecret: resolveSessionSecret(),
	// Accès admin : uniquement depuis le .env, aucune valeur par défaut dans le code.
	adminEmail: String(process.env.ADMIN_EMAIL || '').trim(),
	adminPassword: String(process.env.ADMIN_PASSWORD || ''),
	defaultSettings,
	legal: {
		companyName: String(process.env.LEGAL_COMPANY_NAME || 'Kolokolo').trim(),
		form: String(process.env.LEGAL_FORM || '').trim(),
		capital: String(process.env.LEGAL_CAPITAL || '').trim(),
		ninea: String(process.env.LEGAL_NINEA || '').trim(),
		rccm: String(process.env.LEGAL_RCCM || '').trim(),
		publisher: String(process.env.LEGAL_PUBLISHER || '').trim(),
	},
	features: {
		// Page Carrière masquée tant que CAREER_ENABLED n'est pas à true dans le .env.
		career: String(process.env.CAREER_ENABLED || '').toLowerCase() === 'true',
	},
	smtp: {
		host: String(process.env.SMTP_HOST || '').trim(),
		port: smtpPort,
		secure: String(process.env.SMTP_SECURE || '').toLowerCase() === 'true' || smtpPort === 465,
		user: String(process.env.SMTP_USER || '').trim(),
		password: String(process.env.SMTP_PASSWORD || ''),
		from: String(process.env.MAIL_FROM || '').trim(),
		to: String(process.env.MAIL_TO || '').trim(),
	},
};
