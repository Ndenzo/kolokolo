require('dotenv').config({ path: require('node:path').join(__dirname, '.env') });

const connection = {
	host: process.env.DB_HOST || '127.0.0.1',
	port: Number(process.env.DB_PORT || 3306),
	database: process.env.DB_NAME || 'kolokolo',
	user: process.env.DB_USER || 'root',
	password: String(process.env.DB_PASSWORD ?? ''),
	charset: 'utf8mb4',
};

const config = {
	client: 'mysql2',
	connection,
	pool: { min: 0, max: 10 },
	migrations: {
		directory: './migrations',
		tableName: 'knex_migrations',
	},
};

module.exports = {
	development: config,
	production: config,
};
