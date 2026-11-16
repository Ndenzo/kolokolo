const { seo: seoConfig = {} } = require('../config');

const DEFAULT_IMAGE = '/assets/custom/img/logo/og-share.png';
// Image de partage (réseaux sociaux, messageries) avec le nom et l'accroche, par langue.
const SHARE_IMAGES = {
	fr: '/assets/custom/img/logo/og-share-fr.png',
	en: '/assets/custom/img/logo/og-share-en.png',
};
const DEFAULT_LOGO = '/assets/custom/img/logo/logo.png';
const DEFAULT_IMAGE_WIDTH = 1200;
const DEFAULT_IMAGE_HEIGHT = 630;

const PAGE_DESC_KEYS = {
	home: 'meta.homeDesc',
	about: 'meta.aboutDesc',
	services: 'meta.servicesDesc',
	contact: 'meta.contactDesc',
	career: 'meta.careerDesc',
	'career-details': 'meta.careerDetailsDesc',
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

// Une seule URL par page : sans slash final ni paramètres.
function cleanPath(path) {
	const value = String(path || '/').split(/[?#]/)[0] || '/';
	return value.length > 1 ? value.replace(/\/+$/, '') || '/' : '/';
}

// Fil d'Ariane affiché par Google sous le titre (Accueil › Services…).
const BREADCRUMB_KEYS = {
	contact: 'nav.contact',
	career: 'nav.career',
	'career-details': 'nav.career',
};

const PAGE_TYPES = {
	contact: 'ContactPage',
};

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
	const currentLang = lang === 'en' ? 'en' : 'fr';
	let img = image || SHARE_IMAGES[currentLang] || DEFAULT_IMAGE;
	let ogType = 'website';
	let twitterCard = 'summary_large_image';
	let imageWidth = DEFAULT_IMAGE_WIDTH;
	let imageHeight = DEFAULT_IMAGE_HEIGHT;
	const robots = key === '404' || key === 'newsletter-unsub' ? 'noindex, nofollow' : 'index, follow';

	if (key === 'career-details' && job) {
		desc = stripHtml(job.description_html) || `${job.title} — ${translate('meta.careerDetailsDesc')}`;
	}
	if (key === 'legal' && doc) {
		desc = doc.intro || desc;
	}

	const baseUrl = String(siteUrl || '').replace(/\/$/, '') || 'https://kolokolo.tech';
	const pageUrl = absoluteUrl(siteUrl, cleanPath(path));
	const imageUrl = absoluteUrl(siteUrl, img);
	const place = settings.place || {};
	const sameAs = [settings.facebook, settings.twitter, settings.instagram, settings.linkedin]
		.map(socialUrl)
		.filter(Boolean);
	const locality = place.region || settings.region || 'Dakar';
	const street = place.address || settings.address || undefined;
	// Une URL distincte par langue pour que Google indexe aussi la version anglaise.
	const langUrl = (code) => (code === 'en' ? `${pageUrl}?lang=en` : pageUrl);
	const homeUrl = (code) => (code === 'en' ? `${baseUrl}/?lang=en` : `${baseUrl}/`);
	const url = langUrl(currentLang);
	const alternates = [
		{ hreflang: 'fr', href: langUrl('fr') },
		{ hreflang: 'en', href: langUrl('en') },
		{ hreflang: 'x-default', href: langUrl('fr') },
	];

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
		contactPoint: {
			'@type': 'ContactPoint',
			contactType: 'customer service',
			email: settings.email || 'contact@kolokolo.tech',
			telephone: settings.phone || undefined,
			availableLanguage: ['French', 'English'],
			areaServed: 'Worldwide',
		},
		hasOfferCatalog: serviceCatalog(translate, baseUrl, currentLang),
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
		// Nom court : c'est celui que Google affiche au-dessus du résultat.
		name: brand.name,
		alternateName: [brand.siteName, 'kolokolo.tech'],
		url: baseUrl,
		description: brand.tagline,
		inLanguage: [currentLang === 'en' ? 'en' : 'fr', currentLang === 'en' ? 'fr' : 'en'],
		publisher: { '@id': `${baseUrl}/#organization` },
	};

	const graph = [organization, website];
	const pageTitle = title || brand.siteName;

	if (!robots.startsWith('noindex')) {
		const webPage = {
			'@type': PAGE_TYPES[key] || 'WebPage',
			'@id': `${url}#webpage`,
			url,
			name: pageTitle,
			description: truncateMeta(desc),
			inLanguage: currentLang,
			isPartOf: { '@id': `${baseUrl}/#website` },
			about: { '@id': `${baseUrl}/#organization` },
			primaryImageOfPage: { '@type': 'ImageObject', url: imageUrl },
		};
		const crumbs = breadcrumb({ key, translate, doc, job, url, home: homeUrl(currentLang) });
		if (crumbs) {
			webPage.breadcrumb = { '@id': `${url}#breadcrumb` };
			graph.push(crumbs);
		}
		graph.push(webPage);
	}

	if (key === 'career-details' && job) {
		graph.push(jobPosting({ job, translate, baseUrl, url, place, locality, street }));
	}

	return {
		title: pageTitle,
		description: truncateMeta(desc),
		url,
		alternates: robots.startsWith('noindex') ? [] : alternates,
		image: imageUrl,
		imageAlt: brand.imageAlt,
		imageWidth,
		imageHeight,
		imageType: 'image/png',
		googleVerification: seoConfig.googleVerification || '',
		bingVerification: seoConfig.bingVerification || '',
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

function breadcrumb({ key, translate, doc, job, url, home }) {
	if (key === 'home' || key === '404' || key === 'newsletter-unsub') return null;
	const items = [{ name: translate('nav.home'), item: home }];
	if (key === 'career-details' && job) {
		items.push({ name: translate('nav.career'), item: url.replace(/\/carriere\/[^/?#]+/, '/carriere') });
		items.push({ name: job.title, item: url });
	} else if (key === 'legal' && doc) {
		items.push({ name: doc.heading, item: url });
	} else if (BREADCRUMB_KEYS[key]) {
		items.push({ name: translate(BREADCRUMB_KEYS[key]), item: url });
	} else {
		return null;
	}
	return {
		'@type': 'BreadcrumbList',
		'@id': `${url}#breadcrumb`,
		itemListElement: items.map((entry, index) => ({
			'@type': 'ListItem',
			position: index + 1,
			name: entry.name,
			item: entry.item,
		})),
	};
}

// Catalogue des services (repris des textes du site) pour aider Google à comprendre l'offre.
function serviceCatalog(translate, baseUrl, lang) {
	const items = translate('services.items');
	if (!items || typeof items !== 'object') return undefined;
	return {
		'@type': 'OfferCatalog',
		name: translate('nav.services'),
		url: `${baseUrl}/${lang === 'en' ? '?lang=en' : ''}#services`,
		itemListElement: Object.values(items)
			.filter((item) => item && item.name)
			.map((item) => ({
				'@type': 'Offer',
				itemOffered: {
					'@type': 'Service',
					name: item.name,
					description: item.text || undefined,
					provider: { '@id': `${baseUrl}/#organization` },
					areaServed: 'Worldwide',
				},
			})),
	};
}

const EMPLOYMENT_TYPES = [
	[/cdi|permanent|full[- ]?time|temps plein/i, 'FULL_TIME'],
	[/temps partiel|part[- ]?time/i, 'PART_TIME'],
	[/stage|intern|alternance|apprenti/i, 'INTERN'],
	[/cdd|contrat|contract|freelance|prestat/i, 'CONTRACTOR'],
];

// Offre d'emploi au format Google Jobs (page Carrière, si activée).
function jobPosting({ job, translate, baseUrl, url, place, locality, street }) {
	const match = EMPLOYMENT_TYPES.find(([re]) => re.test(String(job.contract_type || '')));
	const posted = job.created_at || job.updated_at;
	return {
		'@type': 'JobPosting',
		'@id': `${url}#job`,
		title: job.title,
		description: job.description_html || translate('meta.careerDetailsDesc'),
		datePosted: posted ? new Date(posted).toISOString().slice(0, 10) : undefined,
		employmentType: match ? match[1] : undefined,
		hiringOrganization: { '@id': `${baseUrl}/#organization` },
		jobLocation: {
			'@type': 'Place',
			address: {
				'@type': 'PostalAddress',
				streetAddress: street,
				addressLocality: job.location || locality,
				addressRegion: place.region || 'Dakar',
				addressCountry: 'SN',
			},
		},
		directApply: true,
		url,
	};
}

module.exports = { buildHead, cleanPath, DEFAULT_IMAGE, DEFAULT_LOGO };
