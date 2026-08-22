const crypto = require('node:crypto');

const MONTHS_SHORT = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'];
const MONTHS_LONG = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

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

function formatMonthYear(value) {
	const date = asDate(value);
	return `${MONTHS_SHORT[date.getMonth()]} ${date.getFullYear()}`;
}

function formatLongDate(value) {
	const date = asDate(value);
	return `${date.getDate()} ${MONTHS_LONG[date.getMonth()]} ${date.getFullYear()}`;
}

function formatDateTime(value) {
	const date = asDate(value);
	const pad = (n) => String(n).padStart(2, '0');
	return `${formatLongDate(value)} à ${pad(date.getHours())}h${pad(date.getMinutes())}`;
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
	return url || '/assets/front/img/blog/bms1.jpg';
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

module.exports = {
	slugify,
	uniqueSlug,
	formatDay,
	formatMonthYear,
	formatLongDate,
	formatDateTime,
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
