function requireAuth(req, res, next) {
	if (req.session && req.session.userId) return next();
	return res.redirect('/auth');
}

function redirectIfAuth(req, res, next) {
	if (req.session && req.session.userId) return res.redirect('/admin');
	return next();
}

module.exports = { requireAuth, redirectIfAuth };
