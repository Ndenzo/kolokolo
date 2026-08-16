exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('sessions', (table) => {
		table.string('session_id', 128).primary();
		table.integer('expires').unsigned().notNullable();
		table.text('data', 'mediumtext');
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('sessions');
};
