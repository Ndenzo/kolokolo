require('dotenv').config();

const path = require('node:path');
const express = require('express');
const { boot } = require('./db');
const { port } = require('./config');
const { sessionMiddleware } = require('./middleware/session');
const { flash, loadSettings } = require('./middleware/locals');
const { quoteServices, quoteBudgets, quoteTimelines, contactSubjects } = require('./data/services');
const { campaignStatusLabels, subscriberStatusLabels } = require('./data/newsletter');
const helpers = require('./lib/helpers');
const publicRoutes = require('./routes/public');
const authRoutes = require('./routes/auth');
const adminRoutes = require('./routes/admin');

async function start() {
	await boot();

	const app = express();
	app.set('view engine', 'ejs');
	app.set('views', path.join(__dirname, '..', 'views'));
	app.locals.helpers = helpers;
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

	app.use(authRoutes);
	app.use('/admin', adminRoutes);
	app.use(publicRoutes);

	app.use((req, res) => {
		res.status(404).render('layout', { title: 'Page introuvable - Kolokolo', page: '404' });
	});

	app.use((err, req, res, _next) => {
		console.error(err);
		res.status(500).send('Une erreur est survenue.');
	});

	app.listen(port, () => {
		console.log(`Kolokolo server running on http://localhost:${port}`);
	});
}

start().catch((err) => {
	console.error('Impossible de démarrer (base de données) :', err.message);
	console.error('Vérifiez DB_HOST, DB_PORT, DB_NAME, DB_USER et DB_PASSWORD dans le fichier .env, puis créez la base MySQL si besoin : CREATE DATABASE kolokolo CHARACTER SET utf8mb4;');
	process.exit(1);
});
