exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('quote_requests', (table) => {
		table.increments('id').primary();
		table.string('firstname', 120).notNullable();
		table.string('lastname', 120).notNullable();
		table.string('email', 180).notNullable();
		table.string('phone', 80).notNullable();
		table.string('company', 180);
		table.string('services', 500).notNullable();
		table.string('offer', 120);
		table.string('budget', 80);
		table.string('timeline', 80);
		table.text('message').notNullable();
		table.string('status', 20).notNullable().defaultTo('nouveau');
		table.boolean('email_sent').notNullable().defaultTo(false);
		table.string('ip', 80);
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('quote_requests');
};
