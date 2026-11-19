exports.up = async function up(knex) {
	await knex.schema.createTable('document_sequences', (table) => {
		table.string('kind', 20).primary();
		table.integer('next_number').unsigned().notNullable();
	});

	// Le premier devis porte le numéro 50. Les factures ont leur propre série.
	await knex('document_sequences').insert([
		{ kind: 'quote', next_number: 50 },
		{ kind: 'invoice', next_number: 1 },
	]);

	await knex.schema.createTable('customers', (table) => {
		table.increments('id').primary();
		table.string('name', 180).notNullable();
		table.string('contact_name', 180).notNullable().defaultTo('');
		table.string('email', 180).notNullable().defaultTo('');
		table.string('phone', 80).notNullable().defaultTo('');
		table.text('address').notNullable();
		table.string('ninea', 80).notNullable().defaultTo('');
		table.text('notes').notNullable();
		table.timestamps(true, true);
	});

	await knex.schema.createTable('quotes', (table) => {
		table.increments('id').primary();
		table.string('number', 32).notNullable().unique();
		table.integer('customer_id').unsigned().notNullable().references('id').inTable('customers').onDelete('RESTRICT');
		table.integer('quote_request_id').unsigned().nullable().references('id').inTable('quote_requests').onDelete('SET NULL');
		table.string('status', 20).notNullable().defaultTo('brouillon');
		table.string('subject', 255).notNullable().defaultTo('');
		table.date('issued_on').notNullable();
		table.date('valid_until').notNullable();
		table.decimal('tax_rate', 5, 2).notNullable().defaultTo(0);
		table.decimal('deposit_percent', 5, 2).notNullable().defaultTo(0);
		table.boolean('deposit_paid').notNullable().defaultTo(false);
		table.date('deposit_paid_on').nullable();
		table.string('deposit_method', 40).notNullable().defaultTo('');
		table.string('deposit_reference', 120).notNullable().defaultTo('');
		table.text('notes').notNullable();
		table.string('issuer_name', 180).notNullable();
		table.string('issuer_form', 120).notNullable().defaultTo('');
		table.text('issuer_address').notNullable();
		table.string('issuer_email', 180).notNullable().defaultTo('');
		table.string('issuer_phone', 80).notNullable().defaultTo('');
		table.string('issuer_ninea', 80).notNullable().defaultTo('');
		table.string('issuer_rccm', 80).notNullable().defaultTo('');
		table.string('customer_name', 180).notNullable();
		table.string('customer_contact', 180).notNullable().defaultTo('');
		table.string('customer_email', 180).notNullable().defaultTo('');
		table.string('customer_phone', 80).notNullable().defaultTo('');
		table.text('customer_address').notNullable();
		table.string('customer_ninea', 80).notNullable().defaultTo('');
		table.timestamps(true, true);
	});

	await knex.schema.createTable('quote_lines', (table) => {
		table.increments('id').primary();
		table.integer('quote_id').unsigned().notNullable().references('id').inTable('quotes').onDelete('CASCADE');
		table.integer('position').unsigned().notNullable().defaultTo(0);
		table.string('label', 255).notNullable();
		table.text('description').notNullable();
		table.decimal('quantity', 10, 2).notNullable();
		table.decimal('unit_price', 12, 2).notNullable();
	});

	await knex.schema.createTable('invoices', (table) => {
		table.increments('id').primary();
		table.string('number', 32).notNullable().unique();
		table.integer('quote_id').unsigned().notNullable().unique().references('id').inTable('quotes').onDelete('RESTRICT');
		table.integer('customer_id').unsigned().notNullable().references('id').inTable('customers').onDelete('RESTRICT');
		table.string('status', 20).notNullable().defaultTo('emise');
		table.date('issued_on').notNullable();
		table.date('due_on').notNullable();
		table.decimal('tax_rate', 5, 2).notNullable().defaultTo(0);
		table.text('notes').notNullable();
		table.dateTime('cancelled_at').nullable();
		table.string('issuer_name', 180).notNullable();
		table.string('issuer_form', 120).notNullable().defaultTo('');
		table.text('issuer_address').notNullable();
		table.string('issuer_email', 180).notNullable().defaultTo('');
		table.string('issuer_phone', 80).notNullable().defaultTo('');
		table.string('issuer_ninea', 80).notNullable().defaultTo('');
		table.string('issuer_rccm', 80).notNullable().defaultTo('');
		table.string('customer_name', 180).notNullable();
		table.string('customer_contact', 180).notNullable().defaultTo('');
		table.string('customer_email', 180).notNullable().defaultTo('');
		table.string('customer_phone', 80).notNullable().defaultTo('');
		table.text('customer_address').notNullable();
		table.string('customer_ninea', 80).notNullable().defaultTo('');
		table.timestamps(true, true);
	});

	await knex.schema.createTable('invoice_lines', (table) => {
		table.increments('id').primary();
		table.integer('invoice_id').unsigned().notNullable().references('id').inTable('invoices').onDelete('CASCADE');
		table.integer('position').unsigned().notNullable().defaultTo(0);
		table.string('label', 255).notNullable();
		table.text('description').notNullable();
		table.decimal('quantity', 10, 2).notNullable();
		table.decimal('unit_price', 12, 2).notNullable();
	});

	await knex.schema.createTable('payments', (table) => {
		table.increments('id').primary();
		table.integer('invoice_id').unsigned().notNullable().references('id').inTable('invoices').onDelete('CASCADE');
		table.string('kind', 20).notNullable().defaultTo('reglement');
		table.decimal('amount', 12, 2).notNullable();
		table.date('paid_on').notNullable();
		table.string('method', 40).notNullable();
		table.string('reference', 120).notNullable().defaultTo('');
		table.string('note', 255).notNullable().defaultTo('');
		table.timestamps(true, true);
	});
};

exports.down = async function down(knex) {
	await knex.schema.dropTableIfExists('payments');
	await knex.schema.dropTableIfExists('invoice_lines');
	await knex.schema.dropTableIfExists('invoices');
	await knex.schema.dropTableIfExists('quote_lines');
	await knex.schema.dropTableIfExists('quotes');
	await knex.schema.dropTableIfExists('customers');
	await knex.schema.dropTableIfExists('document_sequences');
};
