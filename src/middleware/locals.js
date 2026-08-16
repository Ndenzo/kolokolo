const { db } = require('../db');
const { defaultSettings } = require('../config');
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
	try {
		const row = await db('site_settings').first();
		res.locals.settings = { ...defaultSettings, ...(row || {}) };
	} catch {
		res.locals.settings = defaultSettings;
	}
	res.locals.helpers = helpers;
	next();
}

module.exports = { flash, setFlash, loadSettings };
