const { Router } = require('express');
const bcrypt = require('bcryptjs');
const { db } = require('../db');
const { redirectIfAuth } = require('../middleware/auth');

const router = Router();

router.get('/auth', redirectIfAuth, (req, res) => {
	res.render('admin/login', {
		title: 'Connexion - Kolokolo',
		error: null,
		email: '',
	});
});

router.post('/auth', redirectIfAuth, async (req, res) => {
	const email = String(req.body.email || '').trim().toLowerCase();
	const password = String(req.body.password || '');
	const user = await db('users').where({ email }).first();
	const valid = user && (await bcrypt.compare(password, user.password_hash));
	if (!valid) {
		return res.status(401).render('admin/login', {
			title: 'Connexion - Kolokolo',
			error: 'Identifiants incorrects.',
			email,
		});
	}
	req.session.userId = user.id;
	req.session.userEmail = user.email;
	return req.session.save(() => res.redirect('/admin'));
});

router.post('/auth/logout', (req, res) => {
	req.session.destroy(() => {
		res.redirect('/auth');
	});
});

router.get('/admin/logout', (req, res) => {
	req.session.destroy(() => {
		res.redirect('/auth');
	});
});

module.exports = router;
