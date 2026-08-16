exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('blog_posts', (table) => {
		table.increments('id').primary();
		table.string('title', 255).notNullable();
		table.string('slug', 280).notNullable().unique();
		table.text('excerpt');
		table.string('category', 120);
		table.string('tags', 500);
		table.string('cover_image', 500);
		table.text('intro_html', 'longtext');
		table.text('quote_text');
		table.string('quote_author', 180);
		table.string('secondary_image', 500);
		table.text('secondary_html', 'longtext');
		table.text('body_html', 'longtext');
		table.timestamp('published_at').notNullable().defaultTo(knex.fn.now());
		table.boolean('is_active').notNullable().defaultTo(true);
		table.integer('views').notNullable().defaultTo(0);
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('blog_posts');
};
