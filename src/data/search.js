function fold(text) {
	return String(text || '')
		.normalize('NFD')
		.replace(/[\u0300-\u036f]/g, '')
		.toLowerCase()
		.trim();
}

function matchQuery(query, ...fields) {
	const needle = fold(query);
	if (!needle) return false;
	return fields.some((field) => fold(field).includes(needle));
}

const SEARCH_PAGE_KEYS = [
	{ key: 'home', url: '/' },
	{ key: 'about', url: '/a-propos' },
	{ key: 'services', url: '/services' },
	{ key: 'blog', url: '/blog' },
	{ key: 'contact', url: '/contact' },
	{ key: 'terms', url: '/conditions-generales' },
	{ key: 'privacy', url: '/confidentialite' },
];

const SEARCH_SERVICE_KEYS = [
	{ key: 'web', url: '/services' },
	{ key: 'app', url: '/services' },
	{ key: 'ads', url: '/services' },
	{ key: 'social', url: '/services' },
	{ key: 'seo', url: '/services' },
	{ key: 'maintenance', url: '/services' },
];

function catalogFrom(t, prefix, entries) {
	return entries.map((item) => ({
		title: t(`${prefix}.${item.key}.title`),
		url: item.url,
		excerpt: t(`${prefix}.${item.key}.excerpt`),
	}));
}

function getSearchPages(t) {
	if (typeof t !== 'function') return catalogFrom((key) => key, 'search.pageItems', SEARCH_PAGE_KEYS);
	return catalogFrom(t, 'search.pageItems', SEARCH_PAGE_KEYS);
}

function getSearchServices(t) {
	if (typeof t !== 'function') return catalogFrom((key) => key, 'search.serviceItems', SEARCH_SERVICE_KEYS);
	return catalogFrom(t, 'search.serviceItems', SEARCH_SERVICE_KEYS);
}

const searchPages = getSearchPages((key) => {
	const fr = require('../i18n/fr');
	return key.split('.').reduce((acc, part) => acc && acc[part], fr);
});
const searchServices = getSearchServices((key) => {
	const fr = require('../i18n/fr');
	return key.split('.').reduce((acc, part) => acc && acc[part], fr);
});

function filterItems(query, items) {
	return items
		.filter((item) => matchQuery(query, item.title, item.excerpt))
		.slice(0, 5)
		.map((item) => ({ title: item.title, url: item.url, excerpt: item.excerpt || '' }));
}

module.exports = { fold, matchQuery, searchPages, searchServices, getSearchPages, getSearchServices, filterItems };
