const { db } = require('../db');
const { defaultSettings, siteUrl } = require('../config');
const helpers = require('../lib/helpers');

function flash(req, res, next) {
	res.locals.flash = req.session.flash || null;
	delete req.session.flash;
	res.locals.currentUser = req.session.userId
		? { id: req.session.userId, email: req.session.userEmail }
		: null;
	next();
}

function setFlash(req, type, message) {
	req.session.flash = { type, message };
}

async function loadSettings(req, res, next) {
	res.locals.canonicalPath = req.path;
	res.locals.siteUrl = siteUrl;
	try {
		const row = await db('site_settings').first();
		const settings = { ...defaultSettings, ...(row || {}) };
		settings.place = helpers.contactPlace(settings);
		res.locals.settings = settings;
	} catch {
		res.locals.settings = { ...defaultSettings, place: helpers.contactPlace(defaultSettings) };
	}
	res.locals.helpers = helpers;
	next();
}

module.exports = { flash, setFlash, loadSettings };
