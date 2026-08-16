exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('job_offers', (table) => {
		table.increments('id').primary();
		table.string('title', 255).notNullable();
		table.string('slug', 280).notNullable().unique();
		table.string('contract_type', 80);
		table.string('location', 180);
		table.text('description_html', 'longtext');
		table.boolean('is_active').notNullable().defaultTo(true);
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('job_offers');
};
