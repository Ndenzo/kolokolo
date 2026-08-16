exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('testimonials', (table) => {
		table.increments('id').primary();
		table.string('name', 180).notNullable();
		table.string('role', 255);
		table.text('content').notNullable();
		table.string('photo', 500);
		table.integer('rating').unsigned().notNullable().defaultTo(5);
		table.integer('sort_order').notNullable().defaultTo(0);
		table.boolean('is_active').notNullable().defaultTo(true);
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('testimonials');
};
