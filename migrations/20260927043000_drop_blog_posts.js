exports.up = async function up(knex) {
	await knex.schema.dropTableIfExists('blog_posts');
};

exports.down = async function down(knex) {
	await knex.schema.createTableIfNotExists('blog_posts', (table) => {
		table.increments('id').primary();
		table.string('title', 255).notNullable();
		table.string('slug', 280).notNullable().unique();
		table.text('excerpt');
		table.string('category', 120);
		table.string('tags', 500);
		table.string('cover_image', 500);
		table.string('secondary_image', 500);
		table.text('intro_html');
		table.string('quote_text', 1000);
		table.string('quote_author', 180);
		table.text('secondary_html');
		table.text('body_html');
		table.integer('views').unsigned().notNullable().defaultTo(0);
		table.boolean('is_active').notNullable().defaultTo(true);
		table.timestamp('published_at');
		table.timestamps(true, true);
	});
};
