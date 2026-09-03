#!/usr/bin/env node
'use strict';

/**
 * Génère un site HTML statique dans dist/ pour Hostinger (hébergement sans Node).
 * Contenu issu des seeds (default-content) + settings par défaut.
 * Admin, API recherche et formulaires POST ne sont pas disponibles en mode statique.
 */

const fs = require('node:fs');
const path = require('node:path');
const ejs = require('ejs');

const root = path.resolve(__dirname, '..');
const viewsDir = path.join(root, 'views');
const publicDir = path.join(root, 'public');
const distDir = path.join(root, 'dist');

const { defaultSettings, siteUrl } = require('../src/config');
const helpers = require('../src/lib/helpers');
const { createTranslator, jsBundle } = require('../src/i18n');
const { defaultPosts, defaultTestimonials, defaultProjects, defaultClientLogos } = require('../src/data/default-content');
const { conditionsGenerales, confidentialite } = require('../src/data/legal');

function fail(message) {
	console.error(`\n✖ Export statique échoué: ${message}\n`);
	process.exit(1);
}

function step(label) {
	console.log(`\n→ ${label}`);
}

function rmrf(dir) {
	fs.rmSync(dir, { recursive: true, force: true });
}

function mkdirp(dir) {
	fs.mkdirSync(dir, { recursive: true });
}

function copyDir(src, dest) {
	mkdirp(dest);
	for (const entry of fs.readdirSync(src, { withFileTypes: true })) {
		const from = path.join(src, entry.name);
		const to = path.join(dest, entry.name);
		if (entry.isDirectory()) copyDir(from, to);
		else fs.copyFileSync(from, to);
	}
}

function writeFile(relPath, content) {
	const abs = path.join(distDir, relPath);
	mkdirp(path.dirname(abs));
	fs.writeFileSync(abs, content, 'utf8');
}

function sidebarFromPosts(posts) {
	const recent = posts.slice(0, 5);
	const categoryMap = {};
	const tagSet = new Set();
	for (const post of posts) {
		if (post.category) categoryMap[post.category] = (categoryMap[post.category] || 0) + 1;
		for (const tag of helpers.splitTags(post.tags)) tagSet.add(tag);
	}
	const categories = Object.entries(categoryMap)
		.map(([name, count]) => ({ name, count }))
		.sort((a, b) => a.name.localeCompare(b.name, 'fr'));
	return { recent, categories, tags: [...tagSet].sort((a, b) => a.localeCompare(b, 'fr')) };
}

async function renderLayout(page, title, extra, lang) {
	const t = createTranslator(lang);
	const settings = {
		...defaultSettings,
		place: helpers.contactPlace(defaultSettings),
	};
	const locals = {
		title,
		page,
		canonicalPath: extra.canonicalPath || '/',
		settings,
		siteUrl,
		helpers,
		t,
		lang,
		locale: lang === 'en' ? 'en_US' : 'fr_FR',
		jsI18n: jsBundle(t),
		flash: null,
		currentUser: null,
		clientLogos: defaultClientLogos,
		homePosts: [],
		testimonials: [],
		projects: [],
		posts: [],
		sidebar: { recent: [], categories: [], tags: [] },
		q: '',
		category: '',
		tag: '',
		post: null,
		previous: null,
		next: null,
		jobs: [],
		job: null,
		selectedSubject: '',
		doc: null,
		description: '',
		metaImage: '',
		...extra,
	};

	return ejs.renderFile(path.join(viewsDir, 'layout.ejs'), locals, {
		root: viewsDir,
		filename: path.join(viewsDir, 'layout.ejs'),
	});
}

async function main() {
	step('Préparer dist/');
	rmrf(distDir);
	mkdirp(distDir);

	const lang = 'fr';
	const t = createTranslator(lang);
	const posts = defaultPosts.map((p, i) => ({ ...p, id: i + 1, is_active: 1, views: 0 }));
	const testimonials = defaultTestimonials;
	const projects = defaultProjects;
	const sidebar = sidebarFromPosts(posts);
	const settings = { ...defaultSettings, place: helpers.contactPlace(defaultSettings) };

	const pages = [
		{
			out: 'index.html',
			page: 'home',
			title: t('meta.homeTitle'),
			path: '/',
			extra: { homePosts: posts.slice(0, 3), testimonials, projects },
		},
		{ out: 'a-propos/index.html', page: 'about', title: t('meta.aboutTitle'), path: '/a-propos' },
		{
			out: 'services/index.html',
			page: 'services',
			title: t('meta.servicesTitle'),
			path: '/services',
			extra: { testimonials },
		},
		{
			out: 'blog/index.html',
			page: 'blog',
			title: t('meta.blogTitle'),
			path: '/blog',
			extra: { posts, sidebar },
		},
		{
			out: 'carriere/index.html',
			page: 'career',
			title: t('meta.careerTitle'),
			path: '/carriere',
			extra: { jobs: [] },
		},
		{
			out: 'contact/index.html',
			page: 'contact',
			title: t('meta.contactTitle'),
			path: '/contact',
			extra: { selectedSubject: '' },
		},
		{
			out: 'conditions-generales/index.html',
			page: 'legal',
			title: t('meta.termsTitle'),
			path: '/conditions-generales',
			extra: { doc: conditionsGenerales(settings, lang) },
		},
		{
			out: 'confidentialite/index.html',
			page: 'legal',
			title: t('meta.privacyTitle'),
			path: '/confidentialite',
			extra: { doc: confidentialite(settings, lang) },
		},
		{ out: '404.html', page: '404', title: t('meta.notFoundTitle'), path: '/404' },
	];

	for (let i = 0; i < posts.length; i += 1) {
		const post = posts[i];
		pages.push({
			out: `blog/${post.slug}/index.html`,
			page: 'blog-details',
			title: `${post.title} - Kolokolo`,
			path: `/blog/${post.slug}`,
			extra: {
				post,
				previous: i > 0 ? posts[i - 1] : null,
				next: i < posts.length - 1 ? posts[i + 1] : null,
				sidebar,
			},
		});
	}

	step(`Rendre ${pages.length} pages HTML`);
	for (const item of pages) {
		const html = await renderLayout(item.page, item.title, { canonicalPath: item.path, ...(item.extra || {}) }, lang);
		writeFile(item.out, html);
		console.log(`  ✓ ${item.out}`);
	}

	step('Page maintenance (coming)');
	const comingSrc = path.join(viewsDir, 'coming.ejs');
	const comingHtml = await ejs.renderFile(comingSrc, {}, { filename: comingSrc });
	writeFile('coming/index.html', comingHtml);

	step('Copier les assets publics');
	copyDir(publicDir, distDir);

	step('Export OK');
	console.log('  Sortie: dist/ (à committer sur main pour Hostinger)');
	console.log('  Le .htaccess racine route / vers dist/.\n');
}

main().catch((err) => fail(err.stack || err.message));
