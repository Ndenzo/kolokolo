exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('client_logos', (table) => {
		table.increments('id').primary();
		table.string('name', 180).notNullable();
		table.string('url', 500);
		table.string('logo_color', 500);
		table.string('logo_mono', 500);
		table.integer('sort_order').notNullable().defaultTo(0);
		table.boolean('is_active').notNullable().defaultTo(true);
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('client_logos');
};
