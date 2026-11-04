require('dotenv').config({ path: require('node:path').join(__dirname, '..', '.env') });

const path = require('node:path');
const express = require('express');
const { boot } = require('./db');
const { port } = require('./config');
const { sessionMiddleware } = require('./middleware/session');
const { flash, loadSettings } = require('./middleware/locals');
const { csrfToken, verifyCsrf } = require('./middleware/csrf');
const { quoteServices, quoteBudgets, quoteTimelines, contactSubjects } = require('./data/services');
const { campaignStatusLabels, subscriberStatusLabels } = require('./data/newsletter');
const helpers = require('./lib/helpers');
const publicRoutes = require('./routes/public');
const authRoutes = require('./routes/auth');
const adminRoutes = require('./routes/admin');

async function start() {
	console.log('[kolokolo] démarrage…');
	console.log(`[kolokolo] NODE_ENV=${process.env.NODE_ENV || 'development'} PORT=${port}`);

	await boot();
	console.log('[kolokolo] base de données prête');

	const app = express();
	app.set('trust proxy', 1);
	app.set('view engine', 'ejs');
	app.set('views', path.join(__dirname, '..', 'views'));
	app.locals.helpers = helpers;
	app.locals.features = require('./config').features;
	app.locals.quoteServices = quoteServices;
	app.locals.quoteBudgets = quoteBudgets;
	app.locals.quoteTimelines = quoteTimelines;
	app.locals.contactSubjects = contactSubjects;
	app.locals.campaignStatusLabels = campaignStatusLabels;
	app.locals.subscriberStatusLabels = subscriberStatusLabels;

	app.use(express.urlencoded({ extended: true, limit: '5mb' }));
	app.use(express.json({ limit: '5mb' }));
	app.use(express.static(path.join(__dirname, '..', 'public')));
	app.use(sessionMiddleware());
	app.use(flash);
	app.use(loadSettings);
	app.use(csrfToken);
	app.use(verifyCsrf);

	app.get('/health', (_req, res) => {
		res.status(200).type('text').send('ok');
	});

	app.use(authRoutes);
	app.use('/admin', adminRoutes);
	app.use(publicRoutes);

	app.use((req, res) => {
		res.status(404).render('layout', { title: res.locals.t ? res.locals.t('meta.notFoundTitle') : 'Page introuvable - Kolokolo', page: '404' });
	});

	app.use((err, req, res, _next) => {
		console.error(err);
		res.status(500).send('Une erreur est survenue.');
	});

	const host = process.env.HOST || '0.0.0.0';
	app.listen(port, host, () => {
		console.log(`[kolokolo] écoute sur http://${host}:${port}`);
	});
}

start().catch((err) => {
	console.error('[kolokolo] échec démarrage :', err && err.stack ? err.stack : err);
	console.error('[kolokolo] Vérifiez les variables DB_* / SESSION_SECRET / SITE_URL dans .env (ou le panneau Hostinger).');
	process.exit(1);
});
