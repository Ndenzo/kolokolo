const DEFAULT_IMAGE = '/assets/custom/img/logo/logo.png';

const PAGE_DESC_KEYS = {
	home: 'meta.homeDesc',
	about: 'meta.aboutDesc',
	services: 'meta.servicesDesc',
	blog: 'meta.blogDesc',
	contact: 'meta.contactDesc',
	career: 'meta.careerDesc',
	'career-details': 'meta.careerDetailsDesc',
	'blog-details': 'meta.blogDetailsDesc',
	legal: 'meta.legalDesc',
	'newsletter-unsub': 'meta.unsubDesc',
	404: 'meta.notFoundDesc',
};

function stripHtml(html) {
	return String(html || '')
		.replace(/<[^>]+>/g, ' ')
		.replace(/\s+/g, ' ')
		.trim();
}

function truncateMeta(text, max = 160) {
	const clean = stripHtml(text);
	if (clean.length <= max) return clean;
	return `${clean.slice(0, max - 1).replace(/\s+\S*$/, '')}…`;
}

function absoluteUrl(siteUrl, path) {
	const base = String(siteUrl || '').replace(/\/$/, '');
	const value = String(path || '').trim();
	if (!value) return base || '/';
	if (/^https?:\/\//i.test(value)) return value;
	return `${base}${value.startsWith('/') ? value : `/${value}`}`;
}

function socialUrl(value) {
	const url = String(value || '').trim();
	if (!url || url === '#') return '';
	return url;
}

function jsonLdString(data) {
	return JSON.stringify(data).replace(/</g, '\\u003c');
}

function buildHead({
	title,
	page,
	path,
	settings = {},
	siteUrl,
	post,
	job,
	doc,
	description,
	image,
	t,
} = {}) {
	const key = page || 'home';
	const translate = typeof t === 'function' ? t : (k) => k;
	let desc = description || (PAGE_DESC_KEYS[key] ? translate(PAGE_DESC_KEYS[key]) : '') || translate('meta.defaultDesc');
	let img = image || DEFAULT_IMAGE;
	let ogType = 'website';
	const robots = key === '404' || key === 'newsletter-unsub' ? 'noindex, nofollow' : 'index, follow';

	if (key === 'blog-details' && post) {
		desc = post.excerpt || stripHtml(post.intro_html) || desc;
		img = post.cover_image || img;
		ogType = 'article';
	}
	if (key === 'career-details' && job) {
		desc = stripHtml(job.description_html) || `${job.title} — ${translate('meta.careerDetailsDesc')}`;
	}
	if (key === 'legal' && doc) {
		desc = doc.intro || desc;
	}

	const url = absoluteUrl(siteUrl, path || '/');
	const imageUrl = absoluteUrl(siteUrl, img);
	const place = settings.place || {};
	const sameAs = [settings.facebook, settings.twitter, settings.instagram, settings.linkedin]
		.map(socialUrl)
		.filter(Boolean);

	const organization = {
		'@context': 'https://schema.org',
		'@type': 'ProfessionalService',
		name: 'Kolokolo',
		url: String(siteUrl || '').replace(/\/$/, '') || 'https://kolokolo.tech',
		logo: absoluteUrl(siteUrl, DEFAULT_IMAGE),
		image: imageUrl,
		email: settings.email || 'contact@kolokolo.tech',
		telephone: settings.phone || undefined,
		description: translate('meta.defaultDesc'),
		address: {
			'@type': 'PostalAddress',
			streetAddress: place.address || settings.address || undefined,
			addressLocality: place.region || settings.region || 'Dakar',
			addressCountry: 'SN',
		},
		areaServed: 'SN',
	};
	if (sameAs.length) organization.sameAs = sameAs;

	const graph = [organization];
	if (key === 'blog-details' && post) {
		graph.push({
			'@type': 'Article',
			headline: post.title,
			description: truncateMeta(desc, 200),
			image: imageUrl,
			url,
			datePublished: post.published_at || undefined,
			publisher: {
				'@type': 'Organization',
				name: 'Kolokolo',
				logo: { '@type': 'ImageObject', url: absoluteUrl(siteUrl, DEFAULT_IMAGE) },
			},
		});
	}

	return {
		title: title || 'Kolokolo',
		description: truncateMeta(desc),
		url,
		image: imageUrl,
		robots,
		ogType,
		jsonLd: jsonLdString(graph.length > 1 ? { '@context': 'https://schema.org', '@graph': graph } : organization),
	};
}

module.exports = { buildHead, DEFAULT_IMAGE };
