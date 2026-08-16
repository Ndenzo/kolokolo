exports.up = async function up(knex) {
	const hasColumn = await knex.schema.hasColumn('site_settings', 'country_iso2');
	if (!hasColumn) {
		await knex.schema.table('site_settings', (table) => {
			table.string('country_iso2', 2).notNullable().defaultTo('SN');
		});
	}
};

exports.down = async function down(knex) {
	const hasColumn = await knex.schema.hasColumn('site_settings', 'country_iso2');
	if (hasColumn) {
		await knex.schema.table('site_settings', (table) => {
			table.dropColumn('country_iso2');
		});
	}
};
