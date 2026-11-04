// Nettoyage HTML par liste blanche (sans dépendance) pour le contenu riche saisi dans l'admin.
// Tout ce qui n'est pas explicitement autorisé est supprimé : balises, attributs, gestionnaires
// d'événements (onclick…), styles et URL dangereuses (javascript:, data:…).

const ALLOWED_TAGS = new Set([
	'p', 'br', 'hr', 'strong', 'b', 'em', 'i', 'u', 's', 'span', 'div',
	'h2', 'h3', 'h4', 'h5', 'h6', 'ul', 'ol', 'li', 'blockquote', 'a', 'img',
]);
const VOID_TAGS = new Set(['br', 'hr', 'img']);
const ALLOWED_ATTRS = {
	a: ['href', 'title'],
	img: ['src', 'alt', 'title'],
};
// Balises supprimées avec tout leur contenu.
const DROP_WITH_CONTENT = 'script|style|iframe|object|embed|noscript|template|svg|math|textarea|select|form|head|title|xmp|plaintext';

function decodeEntities(value) {
	return String(value)
		.replace(/&#x([0-9a-f]+);?/gi, (_, hex) => String.fromCodePoint(parseInt(hex, 16) || 0))
		.replace(/&#(\d+);?/g, (_, dec) => String.fromCodePoint(Number(dec) || 0))
		.replace(/&colon;/gi, ':')
		.replace(/&tab;|&newline;/gi, '')
		.replace(/&quot;/g, '"')
		.replace(/&apos;/g, "'")
		.replace(/&lt;/g, '<')
		.replace(/&gt;/g, '>')
		.replace(/&amp;/g, '&');
}

function escapeAttr(value) {
	return String(value).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

function escapeText(value) {
	return String(value)
		.replace(/&(?!(?:[a-z][a-z0-9]{1,31}|#\d{1,7}|#x[0-9a-f]{1,6});)/gi, '&amp;')
		.replace(/</g, '&lt;')
		.replace(/>/g, '&gt;');
}

function safeUrl(raw, { images = false } = {}) {
	const value = decodeEntities(raw).replace(/[\u0000- \u007f-\u009f]/g, '');
	if (!value) return '';
	if (/^(https?:)?\/\//i.test(value)) return value.startsWith('//') ? `https:${value}` : value;
	if (!images && /^(mailto:|tel:)/i.test(value)) return value;
	if (/^[a-z][a-z0-9+.-]*:/i.test(value)) return ''; // javascript:, data:, vbscript:…
	if (value.startsWith('/') || value.startsWith('#')) return value;
	return '';
}

function parseAttrs(source) {
	const attrs = {};
	const re = /([^\s=\/>"']+)(?:\s*=\s*(?:"([^"]*)"|'([^']*)'|([^\s>]+)))?/g;
	let m;
	while ((m = re.exec(source))) {
		attrs[m[1].toLowerCase()] = m[2] ?? m[3] ?? m[4] ?? '';
	}
	return attrs;
}

function buildTag(name, attrSource) {
	const allowed = ALLOWED_ATTRS[name] || [];
	const attrs = parseAttrs(attrSource || '');
	const out = [];
	for (const key of allowed) {
		if (!(key in attrs)) continue;
		let value = attrs[key];
		if (key === 'href') value = safeUrl(value);
		if (key === 'src') value = safeUrl(value, { images: true });
		if ((key === 'href' || key === 'src') && !value) continue;
		out.push(`${key}="${escapeAttr(key === 'href' || key === 'src' ? value : decodeEntities(value))}"`);
	}
	if (name === 'img' && !out.some((a) => a.startsWith('src='))) return '';
	if (name === 'a' && /^https?:/i.test(attrs.href ? safeUrl(attrs.href) : '')) {
		out.push('target="_blank"', 'rel="noopener noreferrer nofollow"');
	}
	return `<${name}${out.length ? ' ' + out.join(' ') : ''}>`;
}

function sanitizeHtml(input) {
	let html = String(input || '');
	html = html.replace(/<!--[\s\S]*?(-->|$)/g, '');
	html = html.replace(new RegExp(`<(${DROP_WITH_CONTENT})\\b[\\s\\S]*?(<\\/\\1\\s*>|$)`, 'gi'), '');

	const tagRe = /<(\/?)([a-zA-Z][a-zA-Z0-9]*)\b((?:[^>"']|"[^"]*"|'[^']*')*)>/g;
	let result = '';
	let last = 0;
	let m;
	while ((m = tagRe.exec(html))) {
		result += escapeText(html.slice(last, m.index));
		last = tagRe.lastIndex;
		const closing = m[1] === '/';
		const name = m[2].toLowerCase();
		if (!ALLOWED_TAGS.has(name)) continue;
		if (closing) {
			if (!VOID_TAGS.has(name)) result += `</${name}>`;
		} else {
			result += buildTag(name, m[3]);
		}
	}
	result += escapeText(html.slice(last));
	return result.trim();
}

module.exports = { sanitizeHtml };
