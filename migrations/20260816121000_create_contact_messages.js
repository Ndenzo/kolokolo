exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('contact_messages', (table) => {
		table.increments('id').primary();
		table.string('firstname', 120).notNullable();
		table.string('lastname', 120).notNullable();
		table.string('email', 180).notNullable();
		table.string('phone', 80);
		table.string('subject', 180);
		table.text('message').notNullable();
		table.string('status', 20).notNullable().defaultTo('nouveau');
		table.boolean('email_sent').notNullable().defaultTo(false);
		table.string('ip', 80);
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('contact_messages');
};
