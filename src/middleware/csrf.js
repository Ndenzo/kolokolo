const crypto = require('node:crypto');

// Protection CSRF « double soumission » : un jeton aléatoire est posé dans un cookie
// httpOnly et recopié dans chaque formulaire (champ _csrf) ou envoyé en en-tête
// X-CSRF-Token pour les requêtes fetch. Les deux doivent correspondre.
const COOKIE_NAME = 'kolokolo-csrf';
const SAFE_METHODS = new Set(['GET', 'HEAD', 'OPTIONS']);

function readCookie(req, name) {
	const header = String(req.headers.cookie || '');
	const match = header.match(new RegExp(`(?:^|;\\s*)${name}=([^;]*)`));
	return match ? decodeURIComponent(match[1]) : '';
}

function sameToken(a, b) {
	const left = Buffer.from(String(a || ''));
	const right = Buffer.from(String(b || ''));
	return left.length === 64 && left.length === right.length && crypto.timingSafeEqual(left, right);
}

function issueToken(req, res) {
	let token = readCookie(req, COOKIE_NAME);
	if (!/^[a-f0-9]{64}$/.test(token)) {
		token = crypto.randomBytes(32).toString('hex');
		res.cookie(COOKIE_NAME, token, {
			httpOnly: true,
			sameSite: 'lax',
			secure: process.env.NODE_ENV === 'production',
			path: '/',
		});
	}
	return token;
}

function rejectCsrf(req, res) {
	const wantsJson = req.xhr || String(req.headers.accept || '').includes('application/json');
	const message = res.locals.t
		? res.locals.t('errors.csrf')
		: 'Votre session a expiré. Rechargez la page puis réessayez.';
	if (wantsJson) return res.status(403).json({ ok: false, error: message });
	return res.status(403).type('html').send(
		`<!doctype html><meta charset="utf-8"><title>Session expirée</title><p style="font-family:sans-serif;padding:40px">${message} <a href="javascript:history.back()">Retour</a></p>`
	);
}

function csrfToken(req, res, next) {
	res.locals.csrfToken = issueToken(req, res);
	next();
}

// Vérifie le jeton sur toutes les requêtes non sûres. Le champ _csrf est lu dans le corps
// (urlencoded / json) ; pour le multipart (upload), seul l'en-tête X-CSRF-Token est utilisé.
function verifyCsrf(req, res, next) {
	if (SAFE_METHODS.has(req.method)) return next();
	const expected = readCookie(req, COOKIE_NAME);
	const sent = (req.body && req.body._csrf) || req.get('x-csrf-token') || '';
	if (!sameToken(expected, sent)) return rejectCsrf(req, res);
	if (req.body && typeof req.body === 'object') delete req.body._csrf;
	return next();
}

module.exports = { csrfToken, verifyCsrf, COOKIE_NAME };
