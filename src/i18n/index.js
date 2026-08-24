const fr = require('./fr');
const en = require('./en');

const dictionaries = { fr, en };
const JS_KEYS = [
	'js.searching',
	'js.noResults',
	'js.searchError',
	'js.quoteService',
	'js.quoteSendError',
	'js.quoteSendFail',
	'js.contactSendError',
	'js.contactSendFail',
	'js.newsletterError',
	'js.newsletterFail',
	'js.choose',
	'js.chooseSubject',
];

function normalizeLang(value) {
	return String(value || '').toLowerCase() === 'en' ? 'en' : 'fr';
}

function lookup(dict, key) {
	return String(key || '')
		.split('.')
		.reduce((acc, part) => (acc && acc[part] != null ? acc[part] : undefined), dict);
}

function interpolate(value, vars) {
	if (!vars || typeof value !== 'string') return value;
	return value.replace(/\{(\w+)\}/g, (_, name) => (vars[name] != null ? String(vars[name]) : ''));
}

function createTranslator(lang) {
	const current = dictionaries[lang] || dictionaries.fr;
	const fallback = dictionaries.fr;
	return function t(key, vars) {
		if (typeof vars === 'string') {
			const map = lookup(current, key) || lookup(fallback, key);
			if (map && typeof map === 'object' && !Array.isArray(map)) {
				return map[vars] != null ? map[vars] : vars;
			}
		}
		let value = lookup(current, key);
		if (value == null) value = lookup(fallback, key);
		if (value == null) return key;
		return interpolate(value, vars);
	};
}

function parseLang(req) {
	const header = String(req.headers.cookie || '');
	const match = header.match(/(?:^|;\s*)kolokolo-lang=([^;]*)/);
	return normalizeLang(match ? decodeURIComponent(match[1]) : '');
}

function jsBundle(t) {
	const bundle = {};
	for (const key of JS_KEYS) bundle[key.replace(/^js\./, '')] = t(key);
	return bundle;
}

function loadLang(req, res, next) {
	const lang = parseLang(req);
	const t = createTranslator(lang);
	res.locals.lang = lang;
	res.locals.locale = lang === 'en' ? 'en_US' : 'fr_FR';
	res.locals.t = t;
	res.locals.jsI18n = jsBundle(t);
	next();
}

module.exports = { normalizeLang, createTranslator, parseLang, loadLang, jsBundle };
