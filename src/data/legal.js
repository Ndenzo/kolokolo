function conditionsGenerales(settings) {
	const place = settings.place || {};
	const address = [place.address, place.regionCountry].filter(Boolean).join(', ');
	return {
		slug: 'conditions-generales',
		heading: 'Conditions générales',
		updated: '20 août 2026',
		intro: 'Les présentes conditions générales encadrent l’accès au site et les prestations proposées par Kolokolo, agence digitale basée à Dakar. En naviguant sur le site ou en nous confiant un projet, vous acceptez ces conditions.',
		sections: [
			{
				title: '1. Éditeur du site',
				paragraphs: [
					`Le site kolokolo.tech est édité par Kolokolo, agence digitale située ${address || 'à Dakar, Sénégal'}.`,
					`Contact : ${settings.email || 'contact@kolokolo.tech'}${settings.phone ? ` — ${settings.phone}` : ''}.`,
				],
			},
			{
				title: '2. Objet',
				paragraphs: [
					'Ces conditions définissent les modalités d’utilisation du site et le cadre des prestations de conception, développement, communication digitale, accompagnement et maintenance proposées par Kolokolo.',
					'Des conditions particulières (devis, contrat, cahier des charges) peuvent compléter ou préciser les présentes. En cas de contradiction, les conditions particulières signées prévalent.',
				],
			},
			{
				title: '3. Accès au site',
				paragraphs: [
					'Le site est accessible gratuitement. Kolokolo s’efforce d’en assurer la disponibilité, sans garantir un accès ininterrompu. Des interruptions peuvent intervenir pour maintenance, mise à jour ou cas de force majeure.',
					'Vous vous engagez à utiliser le site de manière licite, sans porter atteinte à son fonctionnement ni aux droits de tiers.',
				],
			},
			{
				title: '4. Prestations et devis',
				paragraphs: [
					'Les descriptions de services, formules et tarifs présentés sur le site sont indicatifs. Chaque projet fait l’objet d’un devis ou d’une proposition adaptée à vos besoins.',
					'Une demande de devis via le site n’engage ni Kolokolo ni le prospect tant qu’un devis n’a pas été accepté par écrit (email, signature ou tout autre accord formalisé).',
					'Le devis précise le périmètre, les livrables, le calendrier estimatif et les conditions financières. Toute modification de périmètre peut donner lieu à un avenant.',
				],
			},
			{
				title: '5. Commande, délais et livrables',
				paragraphs: [
					'La commande est ferme après acceptation du devis et, le cas échéant, réception de l’acompte prévu.',
					'Les délais indiqués sont estimatifs. Ils dépendent de la fourniture dans les temps des contenus, accès, validations et informations nécessaires de votre part.',
					'Les livrables sont réputés acceptés à défaut de réserve écrite dans un délai de huit (8) jours après leur mise à disposition, sauf délai différent prévu au devis.',
				],
			},
			{
				title: '6. Tarifs et paiement',
				paragraphs: [
					'Les prix sont ceux indiqués sur le devis accepté, hors taxes applicables le cas échéant. Sauf mention contraire, ils s’entendent en francs CFA (XOF).',
					'Les modalités de paiement (acompte, échéances, solde) figurent au devis. Tout retard peut entraîner la suspension des prestations jusqu’à régularisation, sans préjudice des sommes déjà dues.',
				],
			},
			{
				title: '7. Propriété intellectuelle',
				paragraphs: [
					'Le site, ses textes, visuels, logos, marques et éléments graphiques restent la propriété de Kolokolo ou de leurs ayants droit. Toute reproduction non autorisée est interdite.',
					'Sauf accord contraire, Kolokolo conserve la propriété des méthodes, outils et composants génériques utilisés. Les livrables spécifiques au client lui sont cédés selon les modalités du devis, après complet paiement.',
					'Kolokolo peut mentionner le projet dans son portfolio et ses supports de communication, sauf opposition écrite du client.',
				],
			},
			{
				title: '8. Responsabilité',
				paragraphs: [
					'Kolokolo met en œuvre les moyens raisonnables pour réaliser les prestations selon les règles de l’art. Kolokolo ne saurait être tenue responsable des contenus fournis par le client, des choix stratégiques du client, ni des dommages indirects (perte de chiffre d’affaires, de données ou d’opportunité).',
					'La responsabilité de Kolokolo, si elle était engagée, est limitée au montant hors taxes effectivement payé au titre de la prestation concernée.',
				],
			},
			{
				title: '9. Données personnelles',
				paragraphs: [
					'Les informations collectées via le site (formulaires de contact, demandes de devis) sont traitées conformément à notre politique de confidentialité.',
				],
				links: [{ href: '/confidentialite', label: 'Consulter la politique de confidentialité' }],
			},
			{
				title: '10. Droit applicable',
				paragraphs: [
					'Les présentes conditions sont régies par le droit sénégalais. En cas de litige, une solution amiable sera recherchée. À défaut, les tribunaux compétents de Dakar seront saisis.',
				],
			},
		],
	};
}

function confidentialite(settings) {
	const place = settings.place || {};
	const address = [place.address, place.regionCountry].filter(Boolean).join(', ');
	return {
		slug: 'confidentialite',
		heading: 'Confidentialité',
		updated: '20 août 2026',
		intro: 'Kolokolo accorde une importance particulière à la protection de vos données personnelles. Cette politique explique quelles informations nous collectons, pourquoi, et quels sont vos droits.',
		sections: [
			{
				title: '1. Responsable du traitement',
				paragraphs: [
					`Kolokolo, agence digitale sise ${address || 'à Dakar, Sénégal'}, est responsable des traitements réalisés via le site.`,
					`Pour toute question : ${settings.email || 'contact@kolokolo.tech'}${settings.phone ? ` — ${settings.phone}` : ''}.`,
				],
			},
			{
				title: '2. Données collectées',
				paragraphs: [
					'Nous collectons uniquement les données nécessaires aux échanges et à la réalisation des prestations :',
				],
				bullets: [
					'Formulaire de contact : prénom, nom, email, téléphone (facultatif), sujet et message.',
					'Demande de devis : coordonnées, entreprise, services souhaités, budget, délai et description du projet.',
					'Newsletter : adresse email, date d’inscription et, le cas échéant, date de désinscription.',
					'Données techniques minimales : adresse IP, date d’envoi, journaux de sécurité, le cas échéant.',
				],
			},
			{
				title: '3. Finalités',
				paragraphs: [
					'Ces données sont utilisées pour :',
				],
				bullets: [
					'répondre à vos messages et demandes de devis ;',
					'envoyer la newsletter si vous vous y êtes inscrit ;',
					'établir une proposition commerciale et suivre la relation client ;',
					'améliorer le site et assurer sa sécurité ;',
					'respecter nos obligations légales et comptables.',
				],
			},
			{
				title: '4. Base légale',
				paragraphs: [
					'Le traitement repose sur votre demande (prise de contact ou devis), sur votre consentement pour la newsletter, sur l’exécution de mesures précontractuelles ou contractuelles, et, le cas échéant, sur notre intérêt légitime à sécuriser le site et à améliorer nos services.',
				],
			},
			{
				title: '5. Destinataires',
				paragraphs: [
					'Les données sont destinées aux équipes habilitées de Kolokolo. Elles peuvent transiter par nos prestataires techniques (hébergement, messagerie) uniquement pour les besoins du service, et ne sont pas vendues à des tiers.',
				],
			},
			{
				title: '6. Durée de conservation',
				paragraphs: [
					'Les demandes de contact et de devis sont conservées le temps nécessaire au traitement, puis archivées pour une durée limitée compatible avec nos obligations légales (en particulier commerciales et comptables), avant suppression ou anonymisation.',
					'Les inscriptions à la newsletter sont conservées tant que vous restez inscrit. Vous pouvez vous désinscrire à tout moment via le lien présent dans chaque email, ou en nous écrivant.',
				],
			},
			{
				title: '7. Vos droits',
				paragraphs: [
					'Conformément à la loi sénégalaise n° 2008-12 du 25 janvier 2008 sur la protection des données à caractère personnel, vous pouvez demander l’accès, la rectification, la mise à jour ou la suppression de vos données, dans les limites prévues par la loi.',
					`Pour exercer ces droits, écrivez-nous à ${settings.email || 'contact@kolokolo.tech'}. Vous pouvez également saisir la Commission de protection des données personnelles (CDP) du Sénégal.`,
				],
			},
			{
				title: '8. Cookies et traceurs',
				paragraphs: [
					'Le site peut utiliser des cookies techniques nécessaires à son fonctionnement (session, sécurité, préférences d’affichage). Aucun cookie publicitaire n’est déposé sans information préalable.',
					'Vous pouvez configurer votre navigateur pour refuser les cookies. Certaines fonctionnalités du site pourraient alors être limitées.',
				],
			},
			{
				title: '9. Sécurité',
				paragraphs: [
					'Kolokolo met en œuvre des mesures raisonnables pour protéger vos données contre l’accès non autorisé, la perte ou l’altération. Aucun système n’étant infaillible, nous vous invitons à ne transmettre que les informations utiles à votre demande.',
				],
			},
			{
				title: '10. Mise à jour',
				paragraphs: [
					'Cette politique peut être mise à jour pour refléter l’évolution du site ou de la réglementation. La date indiquée en tête de page fait foi.',
				],
				links: [{ href: '/conditions-generales', label: 'Voir aussi les conditions générales' }],
			},
		],
	};
}

module.exports = { conditionsGenerales, confidentialite };
