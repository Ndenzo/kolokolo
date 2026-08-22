exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('newsletter_subscribers', (table) => {
		table.increments('id').primary();
		table.string('email', 180).notNullable().unique();
		table.string('status', 20).notNullable().defaultTo('actif');
		table.string('unsubscribe_token', 64).notNullable().unique();
		table.string('ip', 80);
		table.timestamp('unsubscribed_at');
		table.timestamps(true, true);
	});

	await knex.schema.createTableIfNotExists('newsletter_campaigns', (table) => {
		table.increments('id').primary();
		table.string('subject', 180).notNullable();
		table.text('body_html');
		table.string('status', 20).notNullable().defaultTo('brouillon');
		table.integer('recipient_count').notNullable().defaultTo(0);
		table.integer('sent_count').notNullable().defaultTo(0);
		table.integer('failed_count').notNullable().defaultTo(0);
		table.timestamp('sent_at');
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('newsletter_campaigns');
	await knex.schema.dropTableIfExists('newsletter_subscribers');
};
