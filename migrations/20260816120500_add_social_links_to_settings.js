exports.up = async function up(knex) {
	const hasFacebook = await knex.schema.hasColumn('site_settings', 'facebook');
	if (hasFacebook) return;
	await knex.schema.table('site_settings', (table) => {
		table.string('facebook', 500).nullable();
		table.string('twitter', 500).nullable();
		table.string('instagram', 500).nullable();
		table.string('linkedin', 500).nullable();
	});
};

exports.down = async function down(knex) {
	const hasFacebook = await knex.schema.hasColumn('site_settings', 'facebook');
	if (!hasFacebook) return;
	await knex.schema.table('site_settings', (table) => {
		table.dropColumn('facebook');
		table.dropColumn('twitter');
		table.dropColumn('instagram');
		table.dropColumn('linkedin');
	});
};
