// Les images du portfolio ont été recompressées en WebP (même nom, extension .webp).
// On ne bascule une image que si la version .webp existe bien sur le disque.
const fs = require('node:fs');
const path = require('node:path');

const PUBLIC_DIR = path.join(__dirname, '..', 'public');

exports.up = async function up(knex) {
	const projects = await knex('portfolio_projects').select('id', 'image');
	for (const project of projects) {
		const image = String(project.image || '');
		if (!/^\/uploads\/[^/]+\.png$/i.test(image)) continue;
		const webp = image.replace(/\.png$/i, '.webp');
		if (fs.existsSync(path.join(PUBLIC_DIR, webp))) {
			await knex('portfolio_projects').where({ id: project.id }).update({ image: webp });
		}
	}
};

exports.down = async function down(knex) {
	const projects = await knex('portfolio_projects').select('id', 'image');
	for (const project of projects) {
		const image = String(project.image || '');
		if (!/^\/uploads\/[^/]+\.webp$/i.test(image)) continue;
		const png = image.replace(/\.webp$/i, '.png');
		if (fs.existsSync(path.join(PUBLIC_DIR, png))) {
			await knex('portfolio_projects').where({ id: project.id }).update({ image: png });
		}
	}
};
