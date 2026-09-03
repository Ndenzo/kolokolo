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

function runNode(scriptRel) {
	const result = spawnSync(process.execPath, [path.join(root, scriptRel)], {
		cwd: root,
		stdio: 'inherit',
	});
	if (result.status !== 0) fail(scriptRel);
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
try {
	require(path.join(root, 'src/config'));
	require(path.join(root, 'src/lib/seo'));
	require(path.join(root, 'src/i18n'));
} catch (err) {
	fail(`chargement modules: ${err.message}`);
}

step('Export HTML statique → dist/');
runNode('scripts/export-static.js');

if (!fs.existsSync(path.join(root, 'dist/index.html'))) {
	fail('dist/index.html manquant après export');
}

step('Build OK');
console.log('  CSS compilé + site HTML dans dist/');
console.log('  Hostinger (sans Node) : déployer le contenu de dist/ dans public_html.\n');
