#!/usr/bin/env node
'use strict';

const fs = require('node:fs');
const path = require('node:path');
const { spawnSync } = require('node:child_process');

const root = path.resolve(__dirname, '..');
const scssEntry = path.join(root, 'public/assets/front/scss/main.scss');
const cssOut = path.join(root, 'public/assets/front/css/main.css');

function fail(message) {
	console.error(`\n✖ Build failed: ${message}\n`);
	process.exit(1);
}

function step(label) {
	console.log(`\n→ ${label}`);
}

step('Compile SCSS → CSS');
if (!fs.existsSync(scssEntry)) fail(`SCSS introuvable: ${scssEntry}`);

const sassBin = path.join(root, 'node_modules/.bin/sass');
const sass = spawnSync(
	sassBin,
	[scssEntry, cssOut, '--style=compressed', '--no-source-map'],
	{ cwd: root, stdio: 'inherit', shell: process.platform === 'win32' },
);
if (sass.status !== 0) fail('compilation SCSS');

step('Vérifier les modules serveur');
const required = [
	'src/app.js',
	'src/config.js',
	'src/db.js',
	'src/routes/public.js',
	'src/routes/admin.js',
	'src/routes/auth.js',
	'knexfile.js',
	'package.json',
];
for (const rel of required) {
	const abs = path.join(root, rel);
	if (!fs.existsSync(abs)) fail(`fichier manquant: ${rel}`);
}

try {
	require(path.join(root, 'src/config'));
	require(path.join(root, 'src/lib/seo'));
	require(path.join(root, 'src/i18n'));
} catch (err) {
	fail(`chargement modules: ${err.message}`);
}

step('Build OK');
console.log(`  CSS: ${path.relative(root, cssOut)}`);
console.log('  Entry: src/app.js');
console.log('  Prêt pour déploiement (Hostinger Node.js / VPS).\n');
