const session = require('express-session');
const MySQLStore = require('express-mysql-session')(session);
const knexfile = require('../../knexfile');
const { sessionSecret } = require('../config');

const env = process.env.NODE_ENV || 'development';
const connection = knexfile[env].connection;

function sessionMiddleware() {
	const store = new MySQLStore({
		host: connection.host,
		port: connection.port,
		user: connection.user,
		password: String(connection.password ?? ''),
		database: connection.database,
		charset: 'utf8mb4',
		createDatabaseTable: false,
		schema: {
			tableName: 'sessions',
			columnNames: {
				session_id: 'session_id',
				expires: 'expires',
				data: 'data',
			},
		},
	});

	return session({
		store,
		secret: sessionSecret,
		resave: false,
		saveUninitialized: false,
		cookie: {
			maxAge: 1000 * 60 * 60 * 24 * 7,
			httpOnly: true,
			sameSite: 'lax',
			secure: process.env.NODE_ENV === 'production',
		},
	});
}

module.exports = { sessionMiddleware };
