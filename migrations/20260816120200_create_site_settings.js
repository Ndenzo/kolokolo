exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('site_settings', (table) => {
		table.increments('id').primary();
		table.string('phone', 80).notNullable();
		table.string('email', 255).notNullable();
		table.string('location', 255).notNullable();
		table.string('hours', 120).notNullable();
		table.string('weekend_hours', 120).notNullable();
		table.text('map_embed').notNullable();
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('site_settings');
};
