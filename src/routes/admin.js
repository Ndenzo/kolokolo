const path = require('node:path');
const fs = require('node:fs');
const { Router } = require('express');
const multer = require('multer');
const { db } = require('../db');
const { requireAuth } = require('../middleware/auth');
const { setFlash } = require('../middleware/locals');
const { uniqueSlug, isActive, normalizeEmail, unsubscribeToken, stripHtml } = require('../lib/helpers');
const { countries, findCountry } = require('../data/countries');
const { quoteStatusLabels } = require('../data/services');
const { campaignStatusLabels, subscriberStatusLabels } = require('../data/newsletter');
const { sendNewsletter, isConfigured, contactHtml, quoteHtml } = require('../lib/mailer');
const { renderNewsletterMail, sampleContact, sampleQuote, sampleNewsletter } = require('../lib/emails');
const { siteUrl } = require('../config');
const { sanitizeHtml } = require('../lib/sanitize');

const DEFAULT_PORTFOLIO_CATEGORIES = [
	'Sites vitrines',
	'Applications web',
	'Apps mobiles & bureau',
	'E-commerce',
	'Publicité digitale',
	'Réseaux sociaux',
	'SEO & maintenance',
];

const router = Router();
const uploadDir = path.join(__dirname, '..', '..', 'public', 'uploads');

fs.mkdirSync(uploadDir, { recursive: true });

const storage = multer.diskStorage({
	destination: (_req, _file, cb) => cb(null, uploadDir),
	filename: (_req, file, cb) => {
		const ext = path.extname(file.originalname || '').toLowerCase() || '.jpg';
		cb(null, `${Date.now()}-${Math.round(Math.random() * 1e9)}${ext}`);
	},
});

const upload = multer({
	storage,
	limits: { fileSize: 5 * 1024 * 1024 },
	fileFilter: (_req, file, cb) => {
		if (!/^image\/(jpeg|png|webp|gif|avif|svg\+xml)$/.test(file.mimetype)) {
			return cb(new Error('Format image non pris en charge.'));
		}
		return cb(null, true);
	},
});

function adminPage(res, view, extra = {}) {
	res.render(view, {
		layout: false,
		...extra,
	});
}

function parseActive(body) {
	let value = body.is_active;
	if (Array.isArray(value)) value = value[value.length - 1];
	return value === '1' || value === 'on' || value === true ? 1 : 0;
}

router.use(requireAuth);

router.get('/', async (_req, res) => {
	const [jobs, testimonials, projects, clientLogos, quotes, newQuotes, contacts, newContacts, subscribers, activeSubscribers, campaigns] = await Promise.all([
		db('job_offers').count('id as count').first(),
		db('testimonials').count('id as count').first(),
		db('portfolio_projects').count('id as count').first(),
		db('client_logos').count('id as count').first(),
		db('quote_requests').count('id as count').first(),
		db('quote_requests').where({ status: 'nouveau' }).count('id as count').first(),
		db('contact_messages').count('id as count').first(),
		db('contact_messages').where({ status: 'nouveau' }).count('id as count').first(),
		db('newsletter_subscribers').count('id as count').first(),
		db('newsletter_subscribers').where({ status: 'actif' }).count('id as count').first(),
		db('newsletter_campaigns').count('id as count').first(),
	]);
	adminPage(res, 'admin/dashboard', {
		title: 'Tableau de bord',
		active: 'dashboard',
		stats: {
			jobs: Number(jobs.count || 0),
			testimonials: Number(testimonials.count || 0),
			projects: Number(projects.count || 0),
			clientLogos: Number(clientLogos.count || 0),
			activeJobs: Number((await db('job_offers').where({ is_active: 1 }).count('id as count').first()).count || 0),
			activeTestimonials: Number((await db('testimonials').where({ is_active: 1 }).count('id as count').first()).count || 0),
			activeProjects: Number((await db('portfolio_projects').where({ is_active: 1 }).count('id as count').first()).count || 0),
			activeClientLogos: Number((await db('client_logos').where({ is_active: 1 }).count('id as count').first()).count || 0),
			quotes: Number(quotes.count || 0),
			newQuotes: Number(newQuotes.count || 0),
			contacts: Number(contacts.count || 0),
			newContacts: Number(newContacts.count || 0),
			subscribers: Number(subscribers.count || 0),
			activeSubscribers: Number(activeSubscribers.count || 0),
			campaigns: Number(campaigns.count || 0),
		},
		settings: res.locals.settings,
	});
});

router.get('/emails', (_req, res) => {
	adminPage(res, 'admin/emails/index', {
		title: 'Modèles d’emails',
		active: 'emails',
	});
});

router.get('/emails/contact', async (req, res) => {
	res.type('html').send(await contactHtml(sampleContact, res.locals.settings));
});

router.get('/emails/devis', async (req, res) => {
	res.type('html').send(await quoteHtml(sampleQuote, res.locals.settings));
});

router.get('/emails/newsletter', async (req, res) => {
	const html = await renderNewsletterMail({
		settings: res.locals.settings,
		subject: sampleNewsletter.subject,
		title: sampleNewsletter.subject,
		bodyHtml: sampleNewsletter.bodyHtml,
		unsubscribeUrl: `${siteUrl}/newsletter/desinscription/apercu`,
	});
	res.type('html').send(html);
});

router.get('/settings', async (req, res) => {
	adminPage(res, 'admin/settings', {
		title: 'Informations du site',
		active: 'settings',
		settings: res.locals.settings,
		countries,
	});
});

router.post('/settings', async (req, res) => {
	const country = findCountry(req.body.country_iso2);
	const payload = {
		country_iso2: country.iso2,
		phone: String(req.body.phone || '').trim(),
		email: String(req.body.email || '').trim(),
		region: String(req.body.region || '').trim(),
		address: String(req.body.address || '').trim(),
		hours: String(req.body.hours || '').trim(),
		weekend_hours: String(req.body.weekend_hours || '').trim(),
		map_embed: String(req.body.map_embed || '').trim(),
		facebook: String(req.body.facebook || '').trim(),
		twitter: String(req.body.twitter || '').trim(),
		instagram: String(req.body.instagram || '').trim(),
		linkedin: String(req.body.linkedin || '').trim(),
		updated_at: db.fn.now(),
	};
	payload.location = [payload.region, country.label.toUpperCase()].filter(Boolean).join(', ');
	if (!payload.phone || !payload.email || !payload.region || !payload.address) {
		setFlash(req, 'error', 'Les champs obligatoires doivent être renseignés.');
		return res.redirect('/admin/settings');
	}
	const row = await db('site_settings').first();
	if (row) await db('site_settings').where({ id: row.id }).update(payload);
	else await db('site_settings').insert(payload);
	setFlash(req, 'success', 'Informations du site enregistrées.');
	res.redirect('/admin/settings');
});

router.post('/uploads', (req, res) => {
	upload.single('file')(req, res, (err) => {
		if (err) return res.status(400).json({ error: err.message || 'Upload impossible.' });
		if (!req.file) return res.status(400).json({ error: 'Aucun fichier reçu.' });
		return res.json({ url: `/uploads/${req.file.filename}` });
	});
});

router.get('/jobs', async (req, res) => {
	const jobs = await db('job_offers').orderBy('created_at', 'desc');
	adminPage(res, 'admin/jobs/index', {
		title: 'Offres d’emploi',
		active: 'jobs',
		jobs,
	});
});

router.get('/jobs/new', (req, res) => {
	adminPage(res, 'admin/jobs/form', {
		title: 'Nouvelle offre',
		active: 'jobs',
		job: {
			title: '',
			contract_type: 'CDI',
			location: res.locals.settings.location,
			description_html: '',
			is_active: true,
		},
		action: '/admin/jobs',
	});
});

function jobPayload(body) {
	return {
		title: String(body.title || '').trim(),
		contract_type: String(body.contract_type || '').trim(),
		location: String(body.location || '').trim(),
		description_html: sanitizeHtml(body.description_html),
		is_active: parseActive(body),
		updated_at: db.fn.now(),
	};
}

router.post('/jobs', async (req, res) => {
	const payload = jobPayload(req.body);
	if (!payload.title) {
		setFlash(req, 'error', 'Le titre du poste est obligatoire.');
		return res.redirect('/admin/jobs/new');
	}
	payload.slug = await uniqueSlug(db, 'job_offers', payload.title);
	payload.created_at = db.fn.now();
	await db('job_offers').insert(payload);
	setFlash(req, 'success', 'Offre créée.');
	res.redirect('/admin/jobs');
});

router.get('/jobs/:id/edit', async (req, res) => {
	const job = await db('job_offers').where({ id: req.params.id }).first();
	if (!job) return res.redirect('/admin/jobs');
	adminPage(res, 'admin/jobs/form', {
		title: 'Modifier l’offre',
		active: 'jobs',
		job,
		action: `/admin/jobs/${job.id}`,
	});
});

router.post('/jobs/:id', async (req, res) => {
	const job = await db('job_offers').where({ id: req.params.id }).first();
	if (!job) return res.redirect('/admin/jobs');
	const payload = jobPayload(req.body);
	if (!payload.title) {
		setFlash(req, 'error', 'Le titre du poste est obligatoire.');
		return res.redirect(`/admin/jobs/${job.id}/edit`);
	}
	payload.slug = await uniqueSlug(db, 'job_offers', payload.title, job.id);
	await db('job_offers').where({ id: job.id }).update(payload);
	setFlash(req, 'success', 'Offre mise à jour.');
	res.redirect('/admin/jobs');
});

router.post('/jobs/:id/delete', async (req, res) => {
	await db('job_offers').where({ id: req.params.id }).del();
	setFlash(req, 'success', 'Offre supprimée.');
	res.redirect('/admin/jobs');
});

router.post('/jobs/:id/toggle', async (req, res) => {
	const job = await db('job_offers').where({ id: req.params.id }).first();
	if (job) {
		const active = isActive(job.is_active);
		await db('job_offers').where({ id: job.id }).update({
			is_active: active ? 0 : 1,
			updated_at: db.fn.now(),
		});
		setFlash(req, 'success', active ? 'Offre désactivée.' : 'Offre activée.');
	}
	res.redirect('/admin/jobs');
});

router.get('/testimonials', async (req, res) => {
	const testimonials = await db('testimonials').orderByRaw('sort_order ASC, id ASC');
	adminPage(res, 'admin/testimonials/index', {
		title: 'Témoignages',
		active: 'testimonials',
		testimonials,
	});
});

router.get('/testimonials/new', (req, res) => {
	adminPage(res, 'admin/testimonials/form', {
		title: 'Nouveau témoignage',
		active: 'testimonials',
		item: {
			name: '',
			role: '',
			content: '',
			photo: '',
			rating: 5,
			sort_order: 0,
			is_active: 1,
		},
		action: '/admin/testimonials',
	});
});

function testimonialPayload(body) {
	const rating = Math.min(5, Math.max(1, Number(body.rating || 5)));
	return {
		name: String(body.name || '').trim(),
		role: String(body.role || '').trim(),
		content: String(body.content || '').trim(),
		photo: String(body.photo || '').trim() || null,
		rating,
		sort_order: Number(body.sort_order || 0),
		is_active: parseActive(body),
		updated_at: db.fn.now(),
	};
}

router.post('/testimonials', async (req, res) => {
	const payload = testimonialPayload(req.body);
	if (!payload.name || !payload.content) {
		setFlash(req, 'error', 'Le nom et le témoignage sont obligatoires.');
		return res.redirect('/admin/testimonials/new');
	}
	payload.created_at = db.fn.now();
	await db('testimonials').insert(payload);
	setFlash(req, 'success', 'Témoignage créé.');
	res.redirect('/admin/testimonials');
});

router.get('/testimonials/:id/edit', async (req, res) => {
	const item = await db('testimonials').where({ id: req.params.id }).first();
	if (!item) return res.redirect('/admin/testimonials');
	adminPage(res, 'admin/testimonials/form', {
		title: 'Modifier le témoignage',
		active: 'testimonials',
		item,
		action: `/admin/testimonials/${item.id}`,
	});
});

router.post('/testimonials/:id', async (req, res) => {
	const item = await db('testimonials').where({ id: req.params.id }).first();
	if (!item) return res.redirect('/admin/testimonials');
	const payload = testimonialPayload(req.body);
	if (!payload.name || !payload.content) {
		setFlash(req, 'error', 'Le nom et le témoignage sont obligatoires.');
		return res.redirect(`/admin/testimonials/${item.id}/edit`);
	}
	await db('testimonials').where({ id: item.id }).update(payload);
	setFlash(req, 'success', 'Témoignage mis à jour.');
	res.redirect('/admin/testimonials');
});

router.post('/testimonials/:id/delete', async (req, res) => {
	await db('testimonials').where({ id: req.params.id }).del();
	setFlash(req, 'success', 'Témoignage supprimé.');
	res.redirect('/admin/testimonials');
});

router.post('/testimonials/:id/toggle', async (req, res) => {
	const item = await db('testimonials').where({ id: req.params.id }).first();
	if (item) {
		const active = isActive(item.is_active);
		await db('testimonials').where({ id: item.id }).update({
			is_active: active ? 0 : 1,
			updated_at: db.fn.now(),
		});
		setFlash(req, 'success', active ? 'Témoignage désactivé.' : 'Témoignage activé.');
	}
	res.redirect('/admin/testimonials');
});

router.get('/clients', async (req, res) => {
	const clients = await db('client_logos').orderByRaw('sort_order ASC, id ASC');
	adminPage(res, 'admin/clients/index', {
		title: 'Logos clients',
		active: 'clients',
		clients,
	});
});

router.get('/clients/new', (req, res) => {
	adminPage(res, 'admin/clients/form', {
		title: 'Nouveau logo client',
		active: 'clients',
		item: {
			name: '',
			url: '',
			logo_color: '',
			logo_mono: '',
			sort_order: 0,
			is_active: 1,
		},
		action: '/admin/clients',
	});
});

function clientLogoPayload(body) {
	return {
		name: String(body.name || '').trim(),
		url: String(body.url || '').trim() || null,
		logo_color: String(body.logo_color || '').trim() || null,
		logo_mono: String(body.logo_mono || '').trim() || null,
		sort_order: Number(body.sort_order || 0),
		is_active: parseActive(body),
		updated_at: db.fn.now(),
	};
}

router.post('/clients', async (req, res) => {
	const payload = clientLogoPayload(req.body);
	if (!payload.name || !payload.logo_color || !payload.logo_mono) {
		setFlash(req, 'error', 'Le nom et les deux versions du logo sont obligatoires.');
		return res.redirect('/admin/clients/new');
	}
	payload.created_at = db.fn.now();
	await db('client_logos').insert(payload);
	setFlash(req, 'success', 'Logo client créé.');
	res.redirect('/admin/clients');
});

router.get('/clients/:id/edit', async (req, res) => {
	const item = await db('client_logos').where({ id: req.params.id }).first();
	if (!item) return res.redirect('/admin/clients');
	adminPage(res, 'admin/clients/form', {
		title: 'Modifier le logo client',
		active: 'clients',
		item,
		action: `/admin/clients/${item.id}`,
	});
});

router.post('/clients/:id', async (req, res) => {
	const item = await db('client_logos').where({ id: req.params.id }).first();
	if (!item) return res.redirect('/admin/clients');
	const payload = clientLogoPayload(req.body);
	if (!payload.name || !payload.logo_color || !payload.logo_mono) {
		setFlash(req, 'error', 'Le nom et les deux versions du logo sont obligatoires.');
		return res.redirect(`/admin/clients/${item.id}/edit`);
	}
	await db('client_logos').where({ id: item.id }).update(payload);
	setFlash(req, 'success', 'Logo client mis à jour.');
	res.redirect('/admin/clients');
});

router.post('/clients/:id/delete', async (req, res) => {
	await db('client_logos').where({ id: req.params.id }).del();
	setFlash(req, 'success', 'Logo client supprimé.');
	res.redirect('/admin/clients');
});

router.post('/clients/:id/toggle', async (req, res) => {
	const item = await db('client_logos').where({ id: req.params.id }).first();
	if (item) {
		const active = isActive(item.is_active);
		await db('client_logos').where({ id: item.id }).update({
			is_active: active ? 0 : 1,
			updated_at: db.fn.now(),
		});
		setFlash(req, 'success', active ? 'Logo client masqué.' : 'Logo client activé.');
	}
	res.redirect('/admin/clients');
});

async function projectCategories() {
	const rows = await db('portfolio_projects').distinct('category');
	const fromDb = rows.map((row) => String(row.category || '').trim()).filter(Boolean);
	return Array.from(new Set([...DEFAULT_PORTFOLIO_CATEGORIES, ...fromDb])).sort((a, b) => a.localeCompare(b, 'fr'));
}

router.get('/portfolio', async (req, res) => {
	const projects = await db('portfolio_projects').orderByRaw('sort_order ASC, id ASC');
	adminPage(res, 'admin/portfolio/index', {
		title: 'Portfolio',
		active: 'portfolio',
		projects,
	});
});

router.get('/portfolio/new', async (req, res) => {
	adminPage(res, 'admin/portfolio/form', {
		title: 'Nouveau projet',
		active: 'portfolio',
		categories: await projectCategories(),
		project: {
			title: '',
			category: '',
			image: '',
			link: '',
			sort_order: 0,
			is_active: 1,
		},
		action: '/admin/portfolio',
	});
});

function projectPayload(body) {
	return {
		// Noms de projets toujours en minuscules, pour une présentation homogène.
		title: String(body.title || '').trim().toLocaleLowerCase('fr'),
		category: String(body.category || '').trim(),
		image: String(body.image || '').trim() || null,
		link: String(body.link || '').trim(),
		sort_order: Number(body.sort_order || 0),
		is_active: parseActive(body),
		updated_at: db.fn.now(),
	};
}

router.post('/portfolio', async (req, res) => {
	const payload = projectPayload(req.body);
	if (!payload.title) {
		setFlash(req, 'error', 'Le titre du projet est obligatoire.');
		return res.redirect('/admin/portfolio/new');
	}
	payload.created_at = db.fn.now();
	await db('portfolio_projects').insert(payload);
	setFlash(req, 'success', 'Projet créé.');
	res.redirect('/admin/portfolio');
});

router.get('/portfolio/:id/edit', async (req, res) => {
	const project = await db('portfolio_projects').where({ id: req.params.id }).first();
	if (!project) return res.redirect('/admin/portfolio');
	adminPage(res, 'admin/portfolio/form', {
		title: 'Modifier le projet',
		active: 'portfolio',
		categories: await projectCategories(),
		project,
		action: `/admin/portfolio/${project.id}`,
	});
});

router.post('/portfolio/:id', async (req, res) => {
	const project = await db('portfolio_projects').where({ id: req.params.id }).first();
	if (!project) return res.redirect('/admin/portfolio');
	const payload = projectPayload(req.body);
	if (!payload.title) {
		setFlash(req, 'error', 'Le titre du projet est obligatoire.');
		return res.redirect(`/admin/portfolio/${project.id}/edit`);
	}
	await db('portfolio_projects').where({ id: project.id }).update(payload);
	setFlash(req, 'success', 'Projet mis à jour.');
	res.redirect('/admin/portfolio');
});

router.post('/portfolio/:id/delete', async (req, res) => {
	await db('portfolio_projects').where({ id: req.params.id }).del();
	setFlash(req, 'success', 'Projet supprimé.');
	res.redirect('/admin/portfolio');
});

router.post('/portfolio/:id/toggle', async (req, res) => {
	const project = await db('portfolio_projects').where({ id: req.params.id }).first();
	if (project) {
		const active = isActive(project.is_active);
		await db('portfolio_projects').where({ id: project.id }).update({
			is_active: active ? 0 : 1,
			updated_at: db.fn.now(),
		});
		setFlash(req, 'success', active ? 'Projet désactivé.' : 'Projet activé.');
	}
	res.redirect('/admin/portfolio');
});

router.get('/quotes', async (req, res) => {
	const quotes = await db('quote_requests').orderBy('created_at', 'desc');
	adminPage(res, 'admin/quotes/index', {
		title: 'Demandes de devis',
		active: 'quotes',
		quotes,
		quoteStatusLabels,
	});
});

router.get('/quotes/:id', async (req, res) => {
	const item = await db('quote_requests').where({ id: req.params.id }).first();
	if (!item) return res.redirect('/admin/quotes');
	if (item.status === 'nouveau') {
		await db('quote_requests').where({ id: item.id }).update({ status: 'lu', updated_at: db.fn.now() });
		item.status = 'lu';
	}
	adminPage(res, 'admin/quotes/show', {
		title: 'Demande de devis',
		active: 'quotes',
		item,
		quoteStatusLabels,
	});
});

router.get('/quotes/:id/preview', async (req, res) => {
	const item = await db('quote_requests').where({ id: req.params.id }).first();
	if (!item) return res.status(404).send('Introuvable');
	res.type('html').send(await quoteHtml(item, res.locals.settings));
});

router.post('/quotes/:id/status', async (req, res) => {
	const item = await db('quote_requests').where({ id: req.params.id }).first();
	if (!item) return res.redirect('/admin/quotes');
	const status = String(req.body.status || '').trim();
	if (!quoteStatusLabels[status]) {
		setFlash(req, 'error', 'Statut invalide.');
		return res.redirect(`/admin/quotes/${item.id}`);
	}
	await db('quote_requests').where({ id: item.id }).update({ status, updated_at: db.fn.now() });
	setFlash(req, 'success', 'Statut mis à jour.');
	res.redirect(`/admin/quotes/${item.id}`);
});

router.post('/quotes/:id/delete', async (req, res) => {
	await db('quote_requests').where({ id: req.params.id }).del();
	setFlash(req, 'success', 'Demande de devis supprimée.');
	res.redirect('/admin/quotes');
});

router.get('/contacts', async (req, res) => {
	const messages = await db('contact_messages').orderBy('created_at', 'desc');
	adminPage(res, 'admin/contacts/index', {
		title: 'Messages de contact',
		active: 'contacts',
		messages,
		quoteStatusLabels,
	});
});

router.get('/contacts/:id', async (req, res) => {
	const item = await db('contact_messages').where({ id: req.params.id }).first();
	if (!item) return res.redirect('/admin/contacts');
	if (item.status === 'nouveau') {
		await db('contact_messages').where({ id: item.id }).update({ status: 'lu', updated_at: db.fn.now() });
		item.status = 'lu';
	}
	adminPage(res, 'admin/contacts/show', {
		title: 'Message de contact',
		active: 'contacts',
		item,
		quoteStatusLabels,
	});
});

router.get('/contacts/:id/preview', async (req, res) => {
	const item = await db('contact_messages').where({ id: req.params.id }).first();
	if (!item) return res.status(404).send('Introuvable');
	res.type('html').send(await contactHtml(item, res.locals.settings));
});

router.post('/contacts/:id/status', async (req, res) => {
	const item = await db('contact_messages').where({ id: req.params.id }).first();
	if (!item) return res.redirect('/admin/contacts');
	const status = String(req.body.status || '').trim();
	if (!quoteStatusLabels[status]) {
		setFlash(req, 'error', 'Statut invalide.');
		return res.redirect(`/admin/contacts/${item.id}`);
	}
	await db('contact_messages').where({ id: item.id }).update({ status, updated_at: db.fn.now() });
	setFlash(req, 'success', 'Statut mis à jour.');
	res.redirect(`/admin/contacts/${item.id}`);
});

router.post('/contacts/:id/delete', async (req, res) => {
	await db('contact_messages').where({ id: req.params.id }).del();
	setFlash(req, 'success', 'Message supprimé.');
	res.redirect('/admin/contacts');
});

function campaignPayload(body) {
	return {
		subject: String(body.subject || '').trim().slice(0, 180),
		body_html: String(body.body_html || '').trim(),
	};
}

function unsubscribeLink(token) {
	return `${siteUrl}/newsletter/desinscription/${token}`;
}

router.get('/newsletter', async (_req, res) => {
	const [campaigns, subscriberCount, activeCount] = await Promise.all([
		db('newsletter_campaigns').orderBy('created_at', 'desc'),
		db('newsletter_subscribers').count('id as count').first(),
		db('newsletter_subscribers').where({ status: 'actif' }).count('id as count').first(),
	]);
	adminPage(res, 'admin/newsletter/index', {
		title: 'Newsletter',
		active: 'newsletter',
		campaigns,
		campaignStatusLabels,
		smtpConfigured: isConfigured(),
		stats: {
			campaigns: campaigns.length,
			subscribers: Number(subscriberCount.count || 0),
			active: Number(activeCount.count || 0),
		},
	});
});

router.get('/newsletter/new', (_req, res) => {
	adminPage(res, 'admin/newsletter/form', {
		title: 'Nouvelle newsletter',
		active: 'newsletter',
		campaign: { subject: '', body_html: '' },
		action: '/admin/newsletter',
		smtpConfigured: isConfigured(),
	});
});

router.post('/newsletter', async (req, res) => {
	const payload = campaignPayload(req.body);
	if (!payload.subject) {
		setFlash(req, 'error', 'Le sujet est obligatoire.');
		return res.redirect('/admin/newsletter/new');
	}
	if (!stripHtml(payload.body_html)) {
		setFlash(req, 'error', 'Le contenu de l’email est obligatoire.');
		return res.redirect('/admin/newsletter/new');
	}
	payload.status = 'brouillon';
	payload.created_at = db.fn.now();
	payload.updated_at = db.fn.now();
	const inserted = await db('newsletter_campaigns').insert(payload);
	const id = Array.isArray(inserted) ? inserted[0] : inserted;
	setFlash(req, 'success', 'Brouillon enregistré.');
	res.redirect(`/admin/newsletter/${id}`);
});

router.get('/newsletter/abonnes', async (_req, res) => {
	const subscribers = await db('newsletter_subscribers').orderBy('created_at', 'desc');
	adminPage(res, 'admin/newsletter/subscribers', {
		title: 'Abonnés newsletter',
		active: 'newsletter',
		subscribers,
		subscriberStatusLabels,
	});
});

router.post('/newsletter/abonnes', async (req, res) => {
	const email = normalizeEmail(req.body.email).slice(0, 180);
	if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
		setFlash(req, 'error', 'Merci d’indiquer une adresse email valide.');
		return res.redirect('/admin/newsletter/abonnes');
	}
	const existing = await db('newsletter_subscribers').where({ email }).first();
	if (existing) {
		if (existing.status !== 'actif') {
			await db('newsletter_subscribers').where({ id: existing.id }).update({
				status: 'actif',
				unsubscribed_at: null,
				updated_at: db.fn.now(),
			});
			setFlash(req, 'success', 'L’adresse a été réinscrite.');
		} else {
			setFlash(req, 'error', 'Cette adresse est déjà inscrite.');
		}
		return res.redirect('/admin/newsletter/abonnes');
	}
	await db('newsletter_subscribers').insert({
		email,
		status: 'actif',
		unsubscribe_token: unsubscribeToken(),
		created_at: db.fn.now(),
		updated_at: db.fn.now(),
	});
	setFlash(req, 'success', 'Abonné ajouté.');
	res.redirect('/admin/newsletter/abonnes');
});

router.post('/newsletter/abonnes/:id/delete', async (req, res) => {
	await db('newsletter_subscribers').where({ id: req.params.id }).del();
	setFlash(req, 'success', 'Abonné supprimé.');
	res.redirect('/admin/newsletter/abonnes');
});

router.get('/newsletter/:id', async (req, res) => {
	const campaign = await db('newsletter_campaigns').where({ id: req.params.id }).first();
	if (!campaign) return res.redirect('/admin/newsletter');
	const activeCount = Number((await db('newsletter_subscribers').where({ status: 'actif' }).count('id as count').first()).count || 0);
	adminPage(res, 'admin/newsletter/show', {
		title: campaign.subject,
		active: 'newsletter',
		campaign,
		campaignStatusLabels,
		activeCount,
		smtpConfigured: isConfigured(),
	});
});

router.get('/newsletter/:id/preview', async (req, res) => {
	const campaign = await db('newsletter_campaigns').where({ id: req.params.id }).first();
	if (!campaign) return res.status(404).send('Introuvable');
	const html = await renderNewsletterMail({
		settings: res.locals.settings,
		subject: campaign.subject,
		title: campaign.subject,
		bodyHtml: campaign.body_html,
		unsubscribeUrl: `${siteUrl}/newsletter/desinscription/apercu`,
	});
	res.type('html').send(html);
});

router.get('/newsletter/:id/edit', async (req, res) => {
	const campaign = await db('newsletter_campaigns').where({ id: req.params.id }).first();
	if (!campaign) return res.redirect('/admin/newsletter');
	if (campaign.status !== 'brouillon') {
		setFlash(req, 'error', 'Seuls les brouillons peuvent être modifiés.');
		return res.redirect(`/admin/newsletter/${campaign.id}`);
	}
	adminPage(res, 'admin/newsletter/form', {
		title: 'Modifier la newsletter',
		active: 'newsletter',
		campaign,
		action: `/admin/newsletter/${campaign.id}`,
		smtpConfigured: isConfigured(),
	});
});

router.post('/newsletter/:id', async (req, res) => {
	const campaign = await db('newsletter_campaigns').where({ id: req.params.id }).first();
	if (!campaign) return res.redirect('/admin/newsletter');
	if (campaign.status !== 'brouillon') {
		setFlash(req, 'error', 'Seuls les brouillons peuvent être modifiés.');
		return res.redirect(`/admin/newsletter/${campaign.id}`);
	}
	const payload = campaignPayload(req.body);
	if (!payload.subject) {
		setFlash(req, 'error', 'Le sujet est obligatoire.');
		return res.redirect(`/admin/newsletter/${campaign.id}/edit`);
	}
	if (!stripHtml(payload.body_html)) {
		setFlash(req, 'error', 'Le contenu de l’email est obligatoire.');
		return res.redirect(`/admin/newsletter/${campaign.id}/edit`);
	}
	payload.updated_at = db.fn.now();
	await db('newsletter_campaigns').where({ id: campaign.id }).update(payload);
	setFlash(req, 'success', 'Brouillon mis à jour.');
	res.redirect(`/admin/newsletter/${campaign.id}`);
});

router.post('/newsletter/:id/send', async (req, res) => {
	const campaign = await db('newsletter_campaigns').where({ id: req.params.id }).first();
	if (!campaign) return res.redirect('/admin/newsletter');
	if (campaign.status !== 'brouillon') {
		setFlash(req, 'error', 'Cette newsletter a déjà été envoyée.');
		return res.redirect(`/admin/newsletter/${campaign.id}`);
	}
	if (!stripHtml(campaign.body_html)) {
		setFlash(req, 'error', 'Le contenu de l’email est obligatoire.');
		return res.redirect(`/admin/newsletter/${campaign.id}`);
	}
	const subscribers = await db('newsletter_subscribers').where({ status: 'actif' });
	if (!subscribers.length) {
		setFlash(req, 'error', 'Aucun abonné inscrit pour l’instant.');
		return res.redirect(`/admin/newsletter/${campaign.id}`);
	}
	if (!isConfigured()) {
		setFlash(req, 'error', 'SMTP n’est pas configuré : l’envoi est impossible.');
		return res.redirect(`/admin/newsletter/${campaign.id}`);
	}

	let sentCount = 0;
	let failedCount = 0;
	for (const subscriber of subscribers) {
		try {
			const ok = await sendNewsletter({
				to: subscriber.email,
				subject: campaign.subject,
				bodyHtml: campaign.body_html,
				unsubscribeUrl: unsubscribeLink(subscriber.unsubscribe_token),
				settings: res.locals.settings,
			});
			if (ok) sentCount += 1;
			else failedCount += 1;
		} catch (err) {
			console.error('Envoi newsletter impossible :', err.message);
			failedCount += 1;
		}
	}

	const status = failedCount === 0 ? 'envoye' : sentCount === 0 ? 'echec' : 'partiel';
	await db('newsletter_campaigns').where({ id: campaign.id }).update({
		status,
		recipient_count: subscribers.length,
		sent_count: sentCount,
		failed_count: failedCount,
		sent_at: db.fn.now(),
		updated_at: db.fn.now(),
	});

	if (status === 'envoye') setFlash(req, 'success', `Newsletter envoyée à ${sentCount} abonné${sentCount > 1 ? 's' : ''}.`);
	else if (status === 'partiel') setFlash(req, 'error', `Envoi partiel : ${sentCount} envoyés, ${failedCount} échecs.`);
	else setFlash(req, 'error', 'L’envoi a échoué.');
	res.redirect(`/admin/newsletter/${campaign.id}`);
});

router.post('/newsletter/:id/delete', async (req, res) => {
	await db('newsletter_campaigns').where({ id: req.params.id }).del();
	setFlash(req, 'success', 'Newsletter supprimée.');
	res.redirect('/admin/newsletter');
});

module.exports = router;
