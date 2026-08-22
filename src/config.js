require('dotenv').config();

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

module.exports = {
	port: Number(process.env.PORT || 3000),
	siteUrl: String(process.env.SITE_URL || 'https://kolokolo.tech').replace(/\/$/, ''),
	sessionSecret: process.env.SESSION_SECRET || 'kolokolo-dev-session-secret',
	adminEmail: process.env.ADMIN_EMAIL || 'admin@kolokolo.tech',
	adminPassword: process.env.ADMIN_PASSWORD || 'KolokoloAdmin2026',
	defaultSettings,
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
