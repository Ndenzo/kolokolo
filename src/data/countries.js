const countries = [
	{ iso2: 'SN', label: 'Sénégal', dial: '+221' },
	{ iso2: 'DZ', label: 'Algérie', dial: '+213' },
	{ iso2: 'DE', label: 'Allemagne', dial: '+49' },
	{ iso2: 'BE', label: 'Belgique', dial: '+32' },
	{ iso2: 'BJ', label: 'Bénin', dial: '+229' },
	{ iso2: 'BF', label: 'Burkina Faso', dial: '+226' },
	{ iso2: 'CM', label: 'Cameroun', dial: '+237' },
	{ iso2: 'CA', label: 'Canada', dial: '+1' },
	{ iso2: 'CI', label: 'Côte d’Ivoire', dial: '+225' },
	{ iso2: 'ES', label: 'Espagne', dial: '+34' },
	{ iso2: 'US', label: 'États-Unis', dial: '+1' },
	{ iso2: 'FR', label: 'France', dial: '+33' },
	{ iso2: 'GA', label: 'Gabon', dial: '+241' },
	{ iso2: 'GM', label: 'Gambie', dial: '+220' },
	{ iso2: 'GH', label: 'Ghana', dial: '+233' },
	{ iso2: 'GN', label: 'Guinée', dial: '+224' },
	{ iso2: 'GW', label: 'Guinée-Bissau', dial: '+245' },
	{ iso2: 'IT', label: 'Italie', dial: '+39' },
	{ iso2: 'LU', label: 'Luxembourg', dial: '+352' },
	{ iso2: 'ML', label: 'Mali', dial: '+223' },
	{ iso2: 'MA', label: 'Maroc', dial: '+212' },
	{ iso2: 'MR', label: 'Mauritanie', dial: '+222' },
	{ iso2: 'NE', label: 'Niger', dial: '+227' },
	{ iso2: 'NG', label: 'Nigeria', dial: '+234' },
	{ iso2: 'GB', label: 'Royaume-Uni', dial: '+44' },
	{ iso2: 'CH', label: 'Suisse', dial: '+41' },
	{ iso2: 'TD', label: 'Tchad', dial: '+235' },
	{ iso2: 'TG', label: 'Togo', dial: '+228' },
	{ iso2: 'TN', label: 'Tunisie', dial: '+216' },
];

function findCountry(iso2) {
	const code = String(iso2 || '').toUpperCase();
	return countries.find((country) => country.iso2 === code) || countries[0];
}

module.exports = { countries, findCountry };
