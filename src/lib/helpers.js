const crypto = require('node:crypto');

const MONTHS_SHORT = {
	fr: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
	en: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
};
const MONTHS_LONG = {
	fr: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
	en: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
};

const { findCountry } = require('../data/countries');
const { buildHead } = require('./seo');

function slugify(text) {
	return String(text || '')
		.normalize('NFD')
		.replace(/[\u0300-\u036f]/g, '')
		.toLowerCase()
		.trim()
		.replace(/[^a-z0-9]+/g, '-')
		.replace(/^-+|-+$/g, '')
		.slice(0, 80) || 'item';
}

async function uniqueSlug(db, table, base, excludeId) {
	let slug = slugify(base);
	let candidate = slug;
	let i = 2;
	for (;;) {
		const query = db(table).where({ slug: candidate });
		if (excludeId) query.whereNot('id', excludeId);
		const existing = await query.first();
		if (!existing) return candidate;
		candidate = `${slug}-${i}`;
		i += 1;
	}
}

function asDate(value) {
	if (!value) return new Date();
	return value instanceof Date ? value : new Date(value);
}

function formatDay(value) {
	return String(asDate(value).getDate()).padStart(2, '0');
}

function formatMonthYear(value, lang = 'fr') {
	const date = asDate(value);
	const months = MONTHS_SHORT[lang] || MONTHS_SHORT.fr;
	return `${months[date.getMonth()]} ${date.getFullYear()}`;
}

function formatLongDate(value, lang = 'fr') {
	const date = asDate(value);
	const months = MONTHS_LONG[lang] || MONTHS_LONG.fr;
	return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
}

function formatDateTime(value, lang = 'fr') {
	const date = asDate(value);
	const pad = (n) => String(n).padStart(2, '0');
	const sep = lang === 'en' ? ' at ' : ' à ';
	return `${formatLongDate(value, lang)}${sep}${pad(date.getHours())}h${pad(date.getMinutes())}`;
}

function telHref(phone) {
	return String(phone || '').replace(/[^\d+]/g, '');
}

function splitTags(tags) {
	return String(tags || '')
		.split(',')
		.map((tag) => tag.trim())
		.filter(Boolean);
}

function datetimeLocal(value) {
	const date = asDate(value);
	const pad = (n) => String(n).padStart(2, '0');
	return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T${pad(date.getHours())}:${pad(date.getMinutes())}`;
}

function coverFallback(url) {
	return url || '/assets/front/img/portfolio/port1.jpg';
}

function stripHtml(html) {
	return String(html || '').replace(/<[^>]+>/g, ' ').replace(/\s+/g, ' ').trim();
}

function isActive(value) {
	return value === true || value === 1 || value === '1';
}

function unsubscribeToken() {
	return crypto.randomBytes(24).toString('hex');
}

function normalizeEmail(value) {
	return String(value || '').trim().toLowerCase();
}

function isoDate(value) {
	if (!value) return '';
	if (value instanceof Date && !Number.isNaN(value.getTime())) {
		const pad = (n) => String(n).padStart(2, '0');
		return `${value.getFullYear()}-${pad(value.getMonth() + 1)}-${pad(value.getDate())}`;
	}
	const match = String(value).match(/^(\d{4}-\d{2}-\d{2})/);
	return match ? match[1] : '';
}

function formatIsoDate(value) {
	const iso = isoDate(value);
	if (!iso) return '';
	const [, year, month, day] = iso.match(/^(\d{4})-(\d{2})-(\d{2})/);
	const months = MONTHS_LONG.fr;
	return `${Number(day)} ${months[Number(month) - 1]} ${year}`;
}

function formatMoney(value) {
	const n = Math.round((Number(value) + Number.EPSILON) * 100) / 100;
	if (!Number.isFinite(n)) return '0\u00a0F\u00a0CFA';
	const negative = n < 0;
	const [int, dec] = Math.abs(n).toFixed(2).split('.');
	const grouped = int.replace(/\B(?=(\d{3})+(?!\d))/g, '\u00a0');
	const body = dec === '00' ? grouped : `${grouped},${dec}`;
	return `${negative ? '-' : ''}${body}\u00a0F\u00a0CFA`;
}

function contactPlace(settings) {
	const region = String((settings && settings.region) || '').trim();
	const address = String((settings && settings.address) || '').trim();
	const country = findCountry(settings && settings.country_iso2).label.toUpperCase();
	const regionCountry = [region, country].filter(Boolean).join(', ');
	return {
		address,
		region,
		country,
		regionCountry,
		full: [address, regionCountry].filter(Boolean).join('\n'),
	};
}

const { sanitizeHtml } = require('./sanitize');

// Site vitrine sur une seule page : lien vers une section de l'accueil, en gardant la langue.
function sectionHref(lang, id) {
	return `${lang === 'en' ? '/?lang=en' : '/'}${id ? `#${id}` : ''}`;
}

// Lien vers une page interne en gardant la langue (ex. /contact?lang=en).
function pageHref(lang, path) {
	return lang === 'en' ? `${path}?lang=en` : path;
}

module.exports = {
	sanitizeHtml,
	sectionHref,
	pageHref,
	slugify,
	uniqueSlug,
	formatDay,
	formatMonthYear,
	formatLongDate,
	formatDateTime,
	isoDate,
	formatIsoDate,
	formatMoney,
	telHref,
	splitTags,
	coverFallback,
	stripHtml,
	datetimeLocal,
	isActive,
	contactPlace,
	unsubscribeToken,
	normalizeEmail,
	buildHead,
};
