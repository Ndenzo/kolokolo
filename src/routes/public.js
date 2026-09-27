const { Router } = require('express');
const { db } = require('../db');
const helpers = require('../lib/helpers');
const { sendQuoteRequest, sendContactMessage } = require('../lib/mailer');
const { quoteBudgets, quoteTimelines, allowedServiceLabels, contactSubjects } = require('../data/services');
const { conditionsGenerales, confidentialite } = require('../data/legal');
const { matchQuery, filterItems, getSearchPages, getSearchServices } = require('../data/search');

const router = Router();

function renderPage(res, page, title, extra = {}) {
	res.render('layout', { title, page, ...extra });
}

async function activeTestimonials() {
	return db('testimonials').where({ is_active: 1 }).orderByRaw('sort_order ASC, id ASC');
}

async function activeProjects() {
	return db('portfolio_projects').where({ is_active: 1 }).orderByRaw('sort_order ASC, id ASC');
}

router.get('/', async (req, res) => {
	const [testimonials, projects] = await Promise.all([activeTestimonials(), activeProjects()]);
	renderPage(res, 'home', res.locals.t('meta.homeTitle'), { testimonials, projects });
});

router.get('/recherche', async (req, res) => {
	const q = String(req.query.q || '').trim();
	if (q.length < 2) return res.json({ ok: true, groups: [] });

	const like = `%${q.replace(/[%_\\]/g, '\\$&')}%`;
	try {
		const [projects, jobs] = await Promise.all([
			db('portfolio_projects')
				.where({ is_active: 1 })
				.andWhere((builder) => {
					builder
						.whereRaw('LOWER(title) LIKE LOWER(?)', [like])
						.orWhereRaw('LOWER(IFNULL(category, "")) LIKE LOWER(?)', [like]);
				})
				.orderByRaw('sort_order ASC, id ASC')
				.limit(8),
			db('job_offers')
				.where({ is_active: 1 })
				.andWhere((builder) => {
					builder
						.whereRaw('LOWER(title) LIKE LOWER(?)', [like])
						.orWhereRaw('LOWER(IFNULL(location, "")) LIKE LOWER(?)', [like])
						.orWhereRaw('LOWER(IFNULL(contract_type, "")) LIKE LOWER(?)', [like]);
				})
				.orderBy('created_at', 'desc')
				.limit(6),
		]);

		const t = res.locals.t;
		const groups = [
			{ key: 'pages', label: t('search.pages'), items: filterItems(q, getSearchPages(t)) },
			{ key: 'services', label: t('search.services'), items: filterItems(q, getSearchServices(t)) },
			{
				key: 'portfolio',
				label: t('search.portfolio'),
				items: projects
					.filter((project) => matchQuery(q, project.title, project.category))
					.slice(0, 5)
					.map((project) => ({
						title: project.title,
						url: project.link || '/#portfolio',
						excerpt: project.category || t('search.project'),
					})),
			},
			{
				key: 'carriere',
				label: t('search.career'),
				items: jobs
					.filter((job) => matchQuery(q, job.title, job.location, job.contract_type))
					.slice(0, 5)
					.map((job) => ({
						title: job.title,
						url: `/carriere/${job.slug}`,
						excerpt: [job.contract_type, job.location].filter(Boolean).join(' · '),
					})),
			},
		].filter((group) => group.items.length);

		return res.json({ ok: true, groups });
	} catch (err) {
		console.error(err);
		return res.status(500).json({ ok: false, groups: [], error: res.locals.t('errors.searchFail') });
	}
});

router.get('/coming', (req, res) => {
	res.render('coming');
});

router.get('/a-propos', (req, res) => {
	renderPage(res, 'about', res.locals.t('meta.aboutTitle'));
});

router.get('/services', async (req, res) => {
	const testimonials = await activeTestimonials();
	renderPage(res, 'services', res.locals.t('meta.servicesTitle'), { testimonials });
});

router.get('/carriere', async (req, res) => {
	const jobs = await db('job_offers').where({ is_active: 1 }).orderBy('created_at', 'desc');
	renderPage(res, 'career', res.locals.t('meta.careerTitle'), { jobs });
});

router.get('/carriere/:slug', async (req, res) => {
	const job = await db('job_offers').where({ slug: req.params.slug, is_active: 1 }).first();
	if (!job) {
		return res.status(404).render('layout', { title: res.locals.t('meta.notFoundTitle'), page: '404' });
	}
	renderPage(res, 'career-details', `${job.title} - Kolokolo`, { job });
});

router.post('/carriere', (req, res) => {
	res.redirect('/carriere');
});

router.get('/contact', (req, res) => {
	const selectedSubject = String(req.query.sujet || '').trim();
	renderPage(res, 'contact', res.locals.t('meta.contactTitle'), { selectedSubject });
});

router.get('/conditions-generales', (req, res) => {
	renderPage(res, 'legal', res.locals.t('meta.termsTitle'), {
		doc: conditionsGenerales(res.locals.settings, res.locals.lang),
	});
});

router.get('/confidentialite', (req, res) => {
	renderPage(res, 'legal', res.locals.t('meta.privacyTitle'), {
		doc: confidentialite(res.locals.settings, res.locals.lang),
	});
});

router.post('/contact', async (req, res) => {
	const wantsJson = req.xhr || String(req.headers.accept || '').includes('application/json');
	const reply = (status, payload) => {
		if (wantsJson) return res.status(status).json(payload);
		return res.redirect('/contact');
	};
	if (String(req.body.website || '').trim()) {
		return reply(200, { ok: true });
	}
	const firstname = String(req.body.firstname || '').trim().slice(0, 120);
	const lastname = String(req.body.lastname || '').trim().slice(0, 120);
	const email = String(req.body.email || '').trim().slice(0, 180);
	const phone = String(req.body.phone || '').trim().slice(0, 80);
	const subject = String(req.body.subject || '').trim().slice(0, 180);
	const message = String(req.body.message || '').trim().slice(0, 4000);

	if (!firstname || !lastname || !email || !subject || !message) {
		return reply(400, { ok: false, error: res.locals.t('errors.required') });
	}
	if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
		return reply(400, { ok: false, error: res.locals.t('errors.email') });
	}
	if (subject && !contactSubjects.includes(subject)) {
		return reply(400, { ok: false, error: res.locals.t('errors.subject') });
	}

	const payload = {
		firstname,
		lastname,
		email,
		phone: phone || null,
		subject,
		message,
		status: 'nouveau',
		email_sent: 0,
		ip: String(req.headers['x-forwarded-for'] || req.ip || '').split(',')[0].trim().slice(0, 80) || null,
		created_at: db.fn.now(),
		updated_at: db.fn.now(),
	};

	try {
		const inserted = await db('contact_messages').insert(payload);
		const id = Array.isArray(inserted) ? inserted[0] : inserted;
		try {
			const emailSent = await sendContactMessage(
				{ ...payload, id },
				{ fallbackTo: res.locals.settings && res.locals.settings.email, settings: res.locals.settings }
			);
			if (emailSent) await db('contact_messages').where({ id }).update({ email_sent: 1, updated_at: db.fn.now() });
		} catch (err) {
			console.error('Envoi du message de contact impossible :', err.message);
		}
		return reply(200, { ok: true });
	} catch (err) {
		console.error(err);
		return reply(500, { ok: false, error: res.locals.t('errors.contactFail') });
	}
});

router.post('/devis', async (req, res) => {
	const wantsJson = req.xhr || String(req.headers.accept || '').includes('application/json');
	const reply = (status, payload) => {
		if (wantsJson) return res.status(status).json(payload);
		return res.redirect('/contact');
	};
	if (String(req.body.website || '').trim()) {
		return reply(200, { ok: true });
	}
	const firstname = String(req.body.firstname || '').trim().slice(0, 120);
	const lastname = String(req.body.lastname || '').trim().slice(0, 120);
	const email = String(req.body.email || '').trim().slice(0, 180);
	const phone = String(req.body.phone || '').trim().slice(0, 80);
	const company = String(req.body.company || '').trim().slice(0, 180);
	const offer = String(req.body.offer || '').trim().slice(0, 120);
	const budget = String(req.body.budget || '').trim();
	const timeline = String(req.body.timeline || '').trim();
	const message = String(req.body.message || '').trim().slice(0, 4000);
	const services = allowedServiceLabels(req.body.services);

	if (!firstname || !lastname || !email || !phone || !message || !services.length) {
		return reply(400, { ok: false, error: res.locals.t('errors.quoteRequired') });
	}
	if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
		return reply(400, { ok: false, error: res.locals.t('errors.email') });
	}
	if (budget && !quoteBudgets.includes(budget)) {
		return reply(400, { ok: false, error: res.locals.t('errors.budget') });
	}
	if (timeline && !quoteTimelines.includes(timeline)) {
		return reply(400, { ok: false, error: res.locals.t('errors.timeline') });
	}

	const payload = {
		firstname,
		lastname,
		email,
		phone,
		company: company || null,
		services: services.join(', '),
		offer: offer || null,
		budget: budget || null,
		timeline: timeline || null,
		message,
		status: 'nouveau',
		email_sent: 0,
		ip: String(req.headers['x-forwarded-for'] || req.ip || '').split(',')[0].trim().slice(0, 80) || null,
		created_at: db.fn.now(),
		updated_at: db.fn.now(),
	};

	try {
		const inserted = await db('quote_requests').insert(payload);
		const id = Array.isArray(inserted) ? inserted[0] : inserted;
		let emailSent = false;
		try {
			emailSent = await sendQuoteRequest(
				{ ...payload, id },
				{ fallbackTo: res.locals.settings && res.locals.settings.email, settings: res.locals.settings }
			);
			if (emailSent) await db('quote_requests').where({ id }).update({ email_sent: 1, updated_at: db.fn.now() });
		} catch (err) {
			console.error('Envoi du devis par email impossible :', err.message);
		}
		return reply(200, { ok: true, emailSent });
	} catch (err) {
		console.error(err);
		return reply(500, { ok: false, error: res.locals.t('errors.quoteFail') });
	}
});

router.post('/newsletter', async (req, res) => {
	const wantsJson = req.xhr || String(req.headers.accept || '').includes('application/json');
	const reply = (status, payload) => {
		if (wantsJson) return res.status(status).json(payload);
		return res.redirect(req.get('referer') || '/');
	};
	if (String(req.body.website || '').trim()) {
		return reply(200, { ok: true });
	}
	const email = helpers.normalizeEmail(req.body.email).slice(0, 180);
	if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
		return reply(400, { ok: false, error: res.locals.t('errors.newsletterEmail') });
	}

	const ip = String(req.headers['x-forwarded-for'] || req.ip || '').split(',')[0].trim().slice(0, 80) || null;
	try {
		const existing = await db('newsletter_subscribers').where({ email }).first();
		if (existing) {
			if (existing.status !== 'actif') {
				await db('newsletter_subscribers').where({ id: existing.id }).update({
					status: 'actif',
					unsubscribed_at: null,
					ip,
					updated_at: db.fn.now(),
				});
			}
			return reply(200, { ok: true });
		}
		await db('newsletter_subscribers').insert({
			email,
			status: 'actif',
			unsubscribe_token: helpers.unsubscribeToken(),
			ip,
			created_at: db.fn.now(),
			updated_at: db.fn.now(),
		});
		return reply(200, { ok: true });
	} catch (err) {
		console.error(err);
		return reply(500, { ok: false, error: res.locals.t('errors.newsletterFail') });
	}
});

router.get('/newsletter/desinscription/:token', async (req, res) => {
	const subscriber = await db('newsletter_subscribers').where({ unsubscribe_token: req.params.token }).first();
	if (!subscriber) {
		return res.status(404).render('layout', { title: res.locals.t('meta.notFoundTitle'), page: '404' });
	}
	if (subscriber.status !== 'desinscrit') {
		await db('newsletter_subscribers').where({ id: subscriber.id }).update({
			status: 'desinscrit',
			unsubscribed_at: db.fn.now(),
			updated_at: db.fn.now(),
		});
	}
	renderPage(res, 'newsletter-unsub', res.locals.t('meta.unsubTitle'));
});

module.exports = router;
