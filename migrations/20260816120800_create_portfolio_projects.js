exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('portfolio_projects', (table) => {
		table.increments('id').primary();
		table.string('title', 180).notNullable();
		table.string('category', 120);
		table.string('image', 255);
		table.string('link', 255);
		table.integer('sort_order').notNullable().defaultTo(0);
		table.boolean('is_active').notNullable().defaultTo(true);
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('portfolio_projects');
};
