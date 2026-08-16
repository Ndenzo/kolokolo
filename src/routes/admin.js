const path = require('node:path');
const fs = require('node:fs');
const { Router } = require('express');
const multer = require('multer');
const { db } = require('../db');
const { requireAuth } = require('../middleware/auth');
const { setFlash } = require('../middleware/locals');
const { uniqueSlug, isActive } = require('../lib/helpers');
const { countries, findCountry } = require('../data/countries');
const { quoteStatusLabels } = require('../data/services');

const DEFAULT_CATEGORIES = ['Site Web', 'Social Media', 'Mobile App', 'Publicité Digitale', 'SEO & visibilité'];

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
		if (!/^image\/(jpeg|png|webp|gif|avif)$/.test(file.mimetype)) {
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

async function blogCategories() {
	const rows = await db('blog_posts').distinct('category');
	const fromDb = rows.map((row) => String(row.category || '').trim()).filter(Boolean);
	return Array.from(new Set([...DEFAULT_CATEGORIES, ...fromDb])).sort((a, b) => a.localeCompare(b, 'fr'));
}

router.use(requireAuth);

router.get('/', async (_req, res) => {
	const [posts, jobs, testimonials, projects, quotes, newQuotes, contacts, newContacts, settings] = await Promise.all([
		db('blog_posts').count('id as count').first(),
		db('job_offers').count('id as count').first(),
		db('testimonials').count('id as count').first(),
		db('portfolio_projects').count('id as count').first(),
		db('quote_requests').count('id as count').first(),
		db('quote_requests').where({ status: 'nouveau' }).count('id as count').first(),
		db('contact_messages').count('id as count').first(),
		db('contact_messages').where({ status: 'nouveau' }).count('id as count').first(),
		db('site_settings').first(),
	]);
	adminPage(res, 'admin/dashboard', {
		title: 'Tableau de bord',
		active: 'dashboard',
		stats: {
			posts: Number(posts.count || 0),
			jobs: Number(jobs.count || 0),
			testimonials: Number(testimonials.count || 0),
			projects: Number(projects.count || 0),
			activePosts: Number((await db('blog_posts').where({ is_active: 1 }).count('id as count').first()).count || 0),
			activeJobs: Number((await db('job_offers').where({ is_active: 1 }).count('id as count').first()).count || 0),
			activeTestimonials: Number((await db('testimonials').where({ is_active: 1 }).count('id as count').first()).count || 0),
			activeProjects: Number((await db('portfolio_projects').where({ is_active: 1 }).count('id as count').first()).count || 0),
			quotes: Number(quotes.count || 0),
			newQuotes: Number(newQuotes.count || 0),
			contacts: Number(contacts.count || 0),
			newContacts: Number(newContacts.count || 0),
		},
		settings,
	});
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
		location: String(req.body.location || '').trim(),
		hours: String(req.body.hours || '').trim(),
		weekend_hours: String(req.body.weekend_hours || '').trim(),
		map_embed: String(req.body.map_embed || '').trim(),
		facebook: String(req.body.facebook || '').trim(),
		twitter: String(req.body.twitter || '').trim(),
		instagram: String(req.body.instagram || '').trim(),
		linkedin: String(req.body.linkedin || '').trim(),
		updated_at: db.fn.now(),
	};
	if (!payload.phone || !payload.email || !payload.location) {
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

router.get('/blog', async (req, res) => {
	const posts = await db('blog_posts').orderBy('published_at', 'desc');
	adminPage(res, 'admin/blog/index', {
		title: 'Articles',
		active: 'blog',
		posts,
	});
});

router.get('/blog/new', async (req, res) => {
	adminPage(res, 'admin/blog/form', {
		title: 'Nouvel article',
		active: 'blog',
		categories: await blogCategories(),
		post: {
			title: '',
			excerpt: '',
			category: '',
			tags: '',
			cover_image: '',
			intro_html: '',
			quote_text: '',
			quote_author: '',
			secondary_image: '',
			secondary_html: '',
			body_html: '',
			published_at: new Date(),
			is_active: true,
		},
		action: '/admin/blog',
	});
});

function blogPayload(body) {
	return {
		title: String(body.title || '').trim(),
		excerpt: String(body.excerpt || '').trim(),
		category: String(body.category || '').trim(),
		tags: String(body.tags || '').trim(),
		cover_image: String(body.cover_image || '').trim() || null,
		intro_html: body.intro_html || '',
		quote_text: String(body.quote_text || '').trim(),
		quote_author: String(body.quote_author || '').trim(),
		secondary_image: String(body.secondary_image || '').trim() || null,
		secondary_html: body.secondary_html || '',
		body_html: body.body_html || '',
		published_at: body.published_at ? new Date(body.published_at) : new Date(),
		is_active: parseActive(body),
		updated_at: db.fn.now(),
	};
}

router.post('/blog', async (req, res) => {
	const payload = blogPayload(req.body);
	if (!payload.title) {
		setFlash(req, 'error', 'Le titre est obligatoire.');
		return res.redirect('/admin/blog/new');
	}
	payload.slug = await uniqueSlug(db, 'blog_posts', payload.title);
	payload.created_at = db.fn.now();
	await db('blog_posts').insert(payload);
	setFlash(req, 'success', 'Article créé.');
	res.redirect('/admin/blog');
});

router.get('/blog/:id/edit', async (req, res) => {
	const post = await db('blog_posts').where({ id: req.params.id }).first();
	if (!post) return res.redirect('/admin/blog');
	adminPage(res, 'admin/blog/form', {
		title: 'Modifier l’article',
		active: 'blog',
		categories: await blogCategories(),
		post,
		action: `/admin/blog/${post.id}`,
	});
});

router.post('/blog/:id', async (req, res) => {
	const post = await db('blog_posts').where({ id: req.params.id }).first();
	if (!post) return res.redirect('/admin/blog');
	const payload = blogPayload(req.body);
	if (!payload.title) {
		setFlash(req, 'error', 'Le titre est obligatoire.');
		return res.redirect(`/admin/blog/${post.id}/edit`);
	}
	payload.slug = await uniqueSlug(db, 'blog_posts', payload.title, post.id);
	await db('blog_posts').where({ id: post.id }).update(payload);
	setFlash(req, 'success', 'Article mis à jour.');
	res.redirect('/admin/blog');
});

router.post('/blog/:id/delete', async (req, res) => {
	await db('blog_posts').where({ id: req.params.id }).del();
	setFlash(req, 'success', 'Article supprimé.');
	res.redirect('/admin/blog');
});

router.post('/blog/:id/toggle', async (req, res) => {
	const post = await db('blog_posts').where({ id: req.params.id }).first();
	if (post) {
		const active = isActive(post.is_active);
		await db('blog_posts').where({ id: post.id }).update({
			is_active: active ? 0 : 1,
			updated_at: db.fn.now(),
		});
		setFlash(req, 'success', active ? 'Article désactivé.' : 'Article activé.');
	}
	res.redirect('/admin/blog');
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
		description_html: body.description_html || '',
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

async function projectCategories() {
	const rows = await db('portfolio_projects').distinct('category');
	const fromDb = rows.map((row) => String(row.category || '').trim()).filter(Boolean);
	return Array.from(new Set([...DEFAULT_CATEGORIES, ...fromDb])).sort((a, b) => a.localeCompare(b, 'fr'));
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
		title: String(body.title || '').trim(),
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

module.exports = router;
