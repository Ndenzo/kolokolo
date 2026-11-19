const PAYMENT_METHODS = [
	{ id: 'virement', label: 'Virement bancaire' },
	{ id: 'wave', label: 'Wave' },
	{ id: 'orange_money', label: 'Orange Money' },
	{ id: 'free_money', label: 'Free Money' },
	{ id: 'especes', label: 'Espèces' },
	{ id: 'cheque', label: 'Chèque' },
	{ id: 'autre', label: 'Autre' },
];

const QUOTE_STATUS = {
	brouillon: 'Brouillon',
	envoye: 'Envoyé',
	accepte: 'Accepté',
	refuse: 'Refusé',
	expire: 'Expiré',
	facture: 'Transformé en facture',
};

const INVOICE_STATUS = {
	emise: 'Émise',
	partielle: 'Partiellement payée',
	payee: 'Payée',
	annulee: 'Annulée',
};

const EDITABLE_QUOTE_STATUS = ['brouillon', 'envoye', 'accepte', 'refuse', 'expire'];

const DEFAULT_QUOTE_NOTES = [
	'Prestation de service.',
	"Ce devis est valable 30 jours à compter de sa date d'émission.",
	"La commande est ferme après acceptation du devis et, lorsqu'il est prévu, réception de l'acompte.",
	'Le solde est exigible à réception de la facture.',
	'Règlement par virement bancaire, Wave ou Orange Money.',
].join('\n');

function methodLabel(id) {
	const found = PAYMENT_METHODS.find((item) => item.id === id);
	return found ? found.label : '';
}

module.exports = {
	PAYMENT_METHODS,
	QUOTE_STATUS,
	INVOICE_STATUS,
	EDITABLE_QUOTE_STATUS,
	DEFAULT_QUOTE_NOTES,
	methodLabel,
};
