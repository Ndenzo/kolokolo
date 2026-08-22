const DEFAULT_DESCRIPTION =
	'Kolokolo, agence digitale à Dakar : sites web, e-commerce, applications mobiles, publicité digitale, social media et SEO.';

const DEFAULT_IMAGE = '/assets/custom/img/logo/logo.png';

const PAGE_DESCRIPTIONS = {
	home: 'Agence digitale à Dakar : sites web, applications mobiles, publicité digitale, social media et SEO. Kolokolo vous accompagne de l’idée à la mise en ligne.',
	about: 'Kolokolo, agence digitale basée à Dakar. Découvrez notre approche, nos compétences et notre accompagnement digital.',
	services: 'Sites web, applications mobiles, publicité digitale, social media, SEO et maintenance. Découvrez les services de Kolokolo à Dakar.',
	blog: 'Actualités, conseils et ressources digitales par Kolokolo, agence basée à Dakar.',
	contact: 'Contactez Kolokolo à Dakar pour un projet web, mobile ou de communication digitale.',
	career: 'Rejoignez Kolokolo, agence digitale à Dakar. Consultez nos offres d’emploi.',
	'career-details': 'Offre d’emploi chez Kolokolo, agence digitale à Dakar.',
	'blog-details': 'Article publié par Kolokolo, agence digitale à Dakar.',
	legal: 'Informations légales de Kolokolo, agence digitale basée à Dakar.',
	'newsletter-unsub': 'Vous êtes désinscrit de la newsletter Kolokolo.',
	404: 'La page demandée est introuvable.',
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
} = {}) {
	const key = page || 'home';
	let desc = description || PAGE_DESCRIPTIONS[key] || DEFAULT_DESCRIPTION;
	let img = image || DEFAULT_IMAGE;
	let ogType = 'website';
	const robots = key === '404' || key === 'newsletter-unsub' ? 'noindex, nofollow' : 'index, follow';

	if (key === 'blog-details' && post) {
		desc = post.excerpt || stripHtml(post.intro_html) || desc;
		img = post.cover_image || img;
		ogType = 'article';
	}
	if (key === 'career-details' && job) {
		desc = stripHtml(job.description_html) || `${job.title} — offre d’emploi chez Kolokolo, Dakar.`;
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
		description: DEFAULT_DESCRIPTION,
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

module.exports = { buildHead, DEFAULT_DESCRIPTION, DEFAULT_IMAGE };
