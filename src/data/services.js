const quoteServices = [
	{ id: 'site-web', label: 'Site Web' },
	{ id: 'mobile-app', label: 'Mobile App' },
	{ id: 'publicite', label: 'Publicité Digitale' },
	{ id: 'social-media', label: 'Social Media' },
	{ id: 'seo', label: 'SEO & visibilité' },
	{ id: 'maintenance', label: 'Maintenance' },
];

const quoteBudgets = [
	'À définir',
	'Moins de 150 000 F',
	'150 000 — 350 000 F',
	'350 000 — 650 000 F',
	'Plus de 650 000 F',
];

const quoteTimelines = [
	'Dès que possible',
	'Dans le mois',
	'Dans 1 à 3 mois',
	'Plus tard',
];

const quoteStatusLabels = {
	nouveau: 'Nouveau',
	lu: 'Lu',
	traite: 'Traité',
};

const contactSubjects = [
	'Demande d’information',
	'Nouveau projet',
	'Partenariat',
	'Support / maintenance',
	'Recrutement',
	'Autre',
];

function parseQuoteServices(value) {
	if (Array.isArray(value)) {
		return value.map((item) => String(item || '').trim()).filter(Boolean);
	}
	return String(value || '')
		.split(',')
		.map((item) => item.trim())
		.filter(Boolean);
}

function allowedServiceLabels(values) {
	const allowed = new Set(quoteServices.map((item) => item.label));
	return parseQuoteServices(values).filter((label) => allowed.has(label));
}

module.exports = {
	quoteServices,
	quoteBudgets,
	quoteTimelines,
	quoteStatusLabels,
	contactSubjects,
	parseQuoteServices,
	allowedServiceLabels,
};
