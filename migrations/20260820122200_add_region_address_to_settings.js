exports.up = async function up(knex) {
	const hasRegion = await knex.schema.hasColumn('site_settings', 'region');
	const hasAddress = await knex.schema.hasColumn('site_settings', 'address');
	if (!hasRegion || !hasAddress) {
		await knex.schema.table('site_settings', (table) => {
			if (!hasRegion) table.string('region', 120);
			if (!hasAddress) table.string('address', 255);
		});
	}
	const row = await knex('site_settings').first();
	if (row) {
		const current = String(row.location || '').trim();
		const looksLikeStreet = current && !/^dakar/i.test(current);
		await knex('site_settings').where({ id: row.id }).update({
			region: row.region || 'DAKAR',
			address: row.address || (looksLikeStreet ? current : 'HANN MARISTES 1/B'),
			location: 'DAKAR, SÉNÉGAL',
		});
	}
};

exports.down = async function down(knex) {
	const hasRegion = await knex.schema.hasColumn('site_settings', 'region');
	const hasAddress = await knex.schema.hasColumn('site_settings', 'address');
	if (hasRegion || hasAddress) {
		await knex.schema.table('site_settings', (table) => {
			if (hasAddress) table.dropColumn('address');
			if (hasRegion) table.dropColumn('region');
		});
	}
};
