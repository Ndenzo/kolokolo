const knex = require('knex');
const bcrypt = require('bcryptjs');
const knexfile = require('../knexfile');
const { adminEmail, adminPassword, defaultSettings } = require('./config');
const { defaultPosts, defaultTestimonials, defaultProjects, defaultClientLogos } = require('./data/default-content');

const env = process.env.NODE_ENV || 'development';
const db = knex(knexfile[env]);

async function ensureAdmin() {
	const existing = await db('users').first();
	if (existing) return;
	await db('users').insert({
		email: adminEmail.toLowerCase().trim(),
		password_hash: await bcrypt.hash(adminPassword, 12),
	});
	console.log(`Compte admin créé : ${adminEmail}`);
}

async function ensureSettings() {
	const existing = await db('site_settings').first();
	if (existing) return;
	await db('site_settings').insert(defaultSettings);
}

async function ensureDefaultPosts() {
	const existing = await db('blog_posts').first();
	if (existing) return;
	const now = db.fn.now();
	await db('blog_posts').insert(
		defaultPosts.map((post) => ({
			...post,
			is_active: 1,
			views: 0,
			created_at: now,
			updated_at: now,
		}))
	);
	console.log(`${defaultPosts.length} articles par défaut créés.`);
}

async function ensureDefaultTestimonials() {
	const existing = await db('testimonials').first();
	if (existing) return;
	const now = db.fn.now();
	await db('testimonials').insert(
		defaultTestimonials.map((item) => ({
			...item,
			created_at: now,
			updated_at: now,
		}))
	);
	console.log(`${defaultTestimonials.length} témoignages par défaut créés.`);
}

async function ensureDefaultProjects() {
	const existing = await db('portfolio_projects').first();
	if (existing) return;
	const now = db.fn.now();
	await db('portfolio_projects').insert(
		defaultProjects.map((project) => ({
			...project,
			created_at: now,
			updated_at: now,
		}))
	);
	console.log(`${defaultProjects.length} projets portfolio par défaut créés.`);
}

async function ensureDefaultClientLogos() {
	const existing = await db('client_logos').first();
	if (existing) return;
	const now = db.fn.now();
	await db('client_logos').insert(
		defaultClientLogos.map((item) => ({
			...item,
			created_at: now,
			updated_at: now,
		}))
	);
	console.log(`${defaultClientLogos.length} logos clients par défaut créés.`);
}

async function boot() {
	await db.migrate.latest();
	await ensureAdmin();
	await ensureSettings();
	await ensureDefaultPosts();
	await ensureDefaultTestimonials();
	await ensureDefaultProjects();
	await ensureDefaultClientLogos();
}

module.exports = { db, boot };
