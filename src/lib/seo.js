const DEFAULT_IMAGE = '/assets/custom/img/logo/og-share.png';
const DEFAULT_LOGO = '/assets/custom/img/logo/logo.png';
const DEFAULT_IMAGE_WIDTH = 1200;
const DEFAULT_IMAGE_HEIGHT = 630;

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

function brandIdentity(translate) {
	const knowsAbout = translate('brand.knowsAbout');
	return {
		name: translate('brand.name') || 'Kolokolo',
		siteName: translate('brand.siteName') || 'Kolokolo — Agence digitale internationale',
		tagline: translate('brand.tagline') || 'Depuis Dakar, vers le monde',
		author: translate('brand.author') || 'Kolokolo, agence digitale internationale basée à Dakar (Sénégal)',
		alternateName: translate('brand.alternateName') || 'Kolokolo — L’ibis rouge du digital',
		slogan: translate('brand.slogan') || '',
		imageAlt: translate('brand.imageAlt') || 'Logo Kolokolo',
		knowsAbout: Array.isArray(knowsAbout) ? knowsAbout : [],
	};
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
	lang,
} = {}) {
	const key = page || 'home';
	const translate = typeof t === 'function' ? t : (k) => k;
	const brand = brandIdentity(translate);
	let desc = description || (PAGE_DESC_KEYS[key] ? translate(PAGE_DESC_KEYS[key]) : '') || translate('meta.defaultDesc');
	let img = image || DEFAULT_IMAGE;
	let ogType = 'website';
	let twitterCard = 'summary_large_image';
	let imageWidth = DEFAULT_IMAGE_WIDTH;
	let imageHeight = DEFAULT_IMAGE_HEIGHT;
	const robots = key === '404' || key === 'newsletter-unsub' ? 'noindex, nofollow' : 'index, follow';

	if (key === 'blog-details' && post) {
		desc = post.excerpt || stripHtml(post.intro_html) || desc;
		if (post.cover_image) {
			img = post.cover_image;
			imageWidth = 1200;
			imageHeight = 630;
		}
		ogType = 'article';
	}
	if (key === 'career-details' && job) {
		desc = stripHtml(job.description_html) || `${job.title} — ${translate('meta.careerDetailsDesc')}`;
	}
	if (key === 'legal' && doc) {
		desc = doc.intro || desc;
	}

	const baseUrl = String(siteUrl || '').replace(/\/$/, '') || 'https://kolokolo.tech';
	const url = absoluteUrl(siteUrl, path || '/');
	const imageUrl = absoluteUrl(siteUrl, img);
	const place = settings.place || {};
	const sameAs = [settings.facebook, settings.twitter, settings.instagram, settings.linkedin]
		.map(socialUrl)
		.filter(Boolean);
	const locality = place.region || settings.region || 'Dakar';
	const street = place.address || settings.address || undefined;
	const currentLang = lang === 'en' ? 'en' : 'fr';

	const organization = {
		'@type': ['Organization', 'ProfessionalService'],
		'@id': `${baseUrl}/#organization`,
		name: brand.name,
		legalName: brand.name,
		alternateName: brand.alternateName,
		slogan: brand.slogan || undefined,
		url: baseUrl,
		logo: {
			'@type': 'ImageObject',
			url: absoluteUrl(siteUrl, DEFAULT_LOGO),
			caption: brand.imageAlt,
		},
		image: imageUrl,
		email: settings.email || 'contact@kolokolo.tech',
		telephone: settings.phone || undefined,
		description: translate('meta.defaultDesc'),
		foundingLocation: {
			'@type': 'Place',
			name: 'Dakar, Sénégal',
		},
		address: {
			'@type': 'PostalAddress',
			streetAddress: street,
			addressLocality: locality,
			addressRegion: 'Dakar',
			addressCountry: 'SN',
		},
		areaServed: [
			{ '@type': 'City', name: 'Dakar' },
			{ '@type': 'Country', name: 'Sénégal' },
			{ '@type': 'Continent', name: 'Africa' },
			'Worldwide',
		],
		knowsAbout: brand.knowsAbout.length ? brand.knowsAbout : undefined,
		brand: {
			'@type': 'Brand',
			name: brand.name,
			slogan: brand.slogan || undefined,
			logo: absoluteUrl(siteUrl, DEFAULT_LOGO),
		},
	};
	if (sameAs.length) organization.sameAs = sameAs;

	const website = {
		'@type': 'WebSite',
		'@id': `${baseUrl}/#website`,
		name: brand.siteName,
		alternateName: brand.name,
		url: baseUrl,
		description: brand.tagline,
		inLanguage: [currentLang === 'en' ? 'en' : 'fr', currentLang === 'en' ? 'fr' : 'en'],
		publisher: { '@id': `${baseUrl}/#organization` },
	};

	const graph = [organization, website];
	if (key === 'blog-details' && post) {
		graph.push({
			'@type': 'Article',
			headline: post.title,
			description: truncateMeta(desc, 200),
			image: imageUrl,
			url,
			datePublished: post.published_at || undefined,
			inLanguage: currentLang,
			author: {
				'@type': 'Organization',
				name: brand.name,
				url: baseUrl,
			},
			publisher: {
				'@type': 'Organization',
				name: brand.name,
				logo: { '@type': 'ImageObject', url: absoluteUrl(siteUrl, DEFAULT_LOGO) },
			},
		});
	}

	return {
		title: title || brand.siteName,
		description: truncateMeta(desc),
		url,
		image: imageUrl,
		imageAlt: brand.imageAlt,
		imageWidth,
		imageHeight,
		imageType: 'image/png',
		logo: absoluteUrl(siteUrl, DEFAULT_LOGO),
		twitterCard,
		robots,
		ogType,
		siteName: brand.siteName,
		author: brand.author,
		applicationName: brand.name,
		tagline: brand.tagline,
		jsonLd: jsonLdString({ '@context': 'https://schema.org', '@graph': graph }),
	};
}

module.exports = { buildHead, DEFAULT_IMAGE, DEFAULT_LOGO };
