// Harmonise les noms des projets du portfolio : tout en minuscules.
exports.up = async function up(knex) {
	const projects = await knex('portfolio_projects').select('id', 'title');
	for (const project of projects) {
		const title = String(project.title || '').trim().toLocaleLowerCase('fr');
		if (title !== project.title) {
			await knex('portfolio_projects').where({ id: project.id }).update({ title });
		}
	}
};

exports.down = async function down() {
	// Pas de retour arrière possible : la casse d'origine n'est pas conservée.
};
