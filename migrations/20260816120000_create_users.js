exports.up = async function up(knex) {
	await knex.schema.createTableIfNotExists('users', (table) => {
		table.increments('id').primary();
		table.string('email', 255).notNullable().unique();
		table.string('password_hash', 255).notNullable();
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('users');
};
