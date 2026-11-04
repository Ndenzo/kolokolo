const { legal } = require('../config');

// Hébergeur du site (Hostinger).
const HOST = {
	name: 'Hostinger International Ltd',
	address: '61 Lordou Vironos Street, 6023 Larnaca, Chypre',
	addressEn: '61 Lordou Vironos Street, 6023 Larnaca, Cyprus',
	url: 'https://www.hostinger.com',
};

// Mentions légales : les informations d'immatriculation viennent du .env (LEGAL_*).
// Une ligne n'est affichée que si la valeur correspondante est renseignée.
function legalBullets(settings, address, lang) {
	const fr = lang !== 'en';
	const rows = [
		[fr ? 'Raison sociale' : 'Company name', legal.companyName],
		[fr ? 'Forme juridique' : 'Legal form', legal.form],
		[fr ? 'Capital social' : 'Share capital', legal.capital],
		[fr ? 'Siège social' : 'Registered office', address],
		['NINEA', legal.ninea],
		['RCCM', legal.rccm],
		[fr ? 'Directeur de la publication' : 'Publication director', legal.publisher],
		['Email', settings.email],
		[fr ? 'Téléphone' : 'Phone', settings.phone],
		[fr ? 'Hébergeur' : 'Hosting provider', `${HOST.name}, ${fr ? HOST.address : HOST.addressEn} — ${HOST.url}`],
	];
	return rows.filter(([, value]) => value).map(([label, value]) => `${label} : ${value}`.replace(' : ', fr ? ' : ' : ': '));
}

function conditionsGeneralesFr(settings) {
	const place = settings.place || {};
	const address = [place.address, place.regionCountry].filter(Boolean).join(', ');
	return {
		slug: 'conditions-generales',
		heading: 'Conditions générales',
		updated: '3 novembre 2026',
		intro: 'Les présentes conditions générales encadrent l’accès au site et les prestations proposées par Kolokolo, agence digitale basée à Dakar. En naviguant sur le site ou en nous confiant un projet, vous acceptez ces conditions.',
		sections: [
			{
				title: '1. Mentions légales',
				paragraphs: [
					`Le site kolokolo.tech est édité par ${legal.companyName}, agence digitale située ${address || 'à Dakar, Sénégal'}.`,
				],
				bullets: legalBullets(settings, address, 'fr'),
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
					'Les descriptions de services présentées sur le site sont indicatives. Chaque projet fait l’objet d’un devis ou d’une proposition adaptée à vos besoins.',
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

function confidentialiteFr(settings) {
	const place = settings.place || {};
	const address = [place.address, place.regionCountry].filter(Boolean).join(', ');
	return {
		slug: 'confidentialite',
		heading: 'Confidentialité',
		updated: '3 novembre 2026',
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

function conditionsGeneralesEn(settings) {
	const place = settings.place || {};
	const address = [place.address, place.regionCountry].filter(Boolean).join(', ');
	return {
		slug: 'conditions-generales',
		heading: 'Terms of use',
		updated: '3 November 2026',
		intro: 'These terms govern access to the website and the services offered by Kolokolo, a digital agency based in Dakar. By browsing the site or entrusting us with a project, you accept these terms.',
		sections: [
			{
				title: '1. Legal notice',
				paragraphs: [
					`The website kolokolo.tech is published by ${legal.companyName}, a digital agency located ${address || 'in Dakar, Senegal'}.`,
				],
				bullets: legalBullets(settings, address, 'en'),
			},
			{
				title: '2. Purpose',
				paragraphs: [
					'These terms define how the website may be used and the framework for design, development, digital communication, support and maintenance services offered by Kolokolo.',
					'Specific terms (quote, contract, specifications) may complement or clarify these terms. In case of conflict, the signed specific terms prevail.',
				],
			},
			{
				title: '3. Access to the website',
				paragraphs: [
					'The website is free to access. Kolokolo endeavours to keep it available, without guaranteeing uninterrupted access. Interruptions may occur for maintenance, updates or force majeure.',
					'You agree to use the website lawfully, without disrupting its operation or infringing third-party rights.',
				],
			},
			{
				title: '4. Services and quotes',
				paragraphs: [
					'Service descriptions on the website are indicative. Each project is covered by a quote or proposal tailored to your needs.',
					'A quote request via the website does not bind Kolokolo or the prospect until a quote has been accepted in writing (email, signature or any other formal agreement).',
					'The quote sets out the scope, deliverables, estimated timeline and financial terms. Any change of scope may lead to an amendment.',
				],
			},
			{
				title: '5. Order, timelines and deliverables',
				paragraphs: [
					'The order is firm once the quote is accepted and, where applicable, the deposit has been received.',
					'Stated timelines are estimates. They depend on timely provision of content, access, approvals and information from you.',
					'Deliverables are deemed accepted if no written reservation is made within eight (8) days after they are made available, unless a different period is set in the quote.',
				],
			},
			{
				title: '6. Prices and payment',
				paragraphs: [
					'Prices are those stated in the accepted quote, exclusive of applicable taxes. Unless otherwise stated, they are in CFA francs (XOF).',
					'Payment terms (deposit, instalments, balance) appear in the quote. Any delay may lead to suspension of services until regularisation, without prejudice to amounts already due.',
				],
			},
			{
				title: '7. Intellectual property',
				paragraphs: [
					'The website, its texts, visuals, logos, trademarks and graphic elements remain the property of Kolokolo or their rights holders. Unauthorised reproduction is prohibited.',
					'Unless otherwise agreed, Kolokolo retains ownership of methods, tools and generic components used. Client-specific deliverables are assigned as set out in the quote, after full payment.',
					'Kolokolo may mention the project in its portfolio and communication materials, unless the client objects in writing.',
				],
			},
			{
				title: '8. Liability',
				paragraphs: [
					'Kolokolo uses reasonable means to perform the services according to professional standards. Kolokolo cannot be held liable for content provided by the client, the client’s strategic choices, or indirect damages (loss of revenue, data or opportunity).',
					'If Kolokolo’s liability were engaged, it would be limited to the amount actually paid, exclusive of tax, for the service concerned.',
				],
			},
			{
				title: '9. Personal data',
				paragraphs: [
					'Information collected via the website (contact forms, quote requests) is processed in accordance with our privacy policy.',
				],
				links: [{ href: '/confidentialite', label: 'Read the privacy policy' }],
			},
			{
				title: '10. Governing law',
				paragraphs: [
					'These terms are governed by Senegalese law. In case of dispute, an amicable solution will be sought. Failing that, the competent courts of Dakar will have jurisdiction.',
				],
			},
		],
	};
}

function confidentialiteEn(settings) {
	const place = settings.place || {};
	const address = [place.address, place.regionCountry].filter(Boolean).join(', ');
	return {
		slug: 'confidentialite',
		heading: 'Privacy',
		updated: '3 November 2026',
		intro: 'Kolokolo takes the protection of your personal data seriously. This policy explains what information we collect, why, and what your rights are.',
		sections: [
			{
				title: '1. Data controller',
				paragraphs: [
					`Kolokolo, a digital agency located ${address || 'in Dakar, Senegal'}, is responsible for processing carried out via the website.`,
					`For any question: ${settings.email || 'contact@kolokolo.tech'}${settings.phone ? ` — ${settings.phone}` : ''}.`,
				],
			},
			{
				title: '2. Data collected',
				paragraphs: ['We only collect data needed for exchanges and to deliver our services:'],
				bullets: [
					'Contact form: first name, last name, email, phone (optional), subject and message.',
					'Quote request: contact details, company, requested services, budget, timeline and project description.',
					'Newsletter: email address, subscription date and, where applicable, unsubscribe date.',
					'Minimal technical data: IP address, send date, security logs, where applicable.',
				],
			},
			{
				title: '3. Purposes',
				paragraphs: ['This data is used to:'],
				bullets: [
					'reply to your messages and quote requests;',
					'send the newsletter if you subscribed;',
					'prepare a commercial proposal and manage the client relationship;',
					'improve the website and keep it secure;',
					'meet our legal and accounting obligations.',
				],
			},
			{
				title: '4. Legal basis',
				paragraphs: [
					'Processing is based on your request (contact or quote), your consent for the newsletter, the performance of pre-contractual or contractual measures, and, where applicable, our legitimate interest in securing the website and improving our services.',
				],
			},
			{
				title: '5. Recipients',
				paragraphs: [
					'Data is intended for authorised Kolokolo teams. It may pass through our technical providers (hosting, email) only as needed for the service, and is not sold to third parties.',
				],
			},
			{
				title: '6. Retention period',
				paragraphs: [
					'Contact and quote requests are kept for as long as needed to process them, then archived for a limited period consistent with our legal obligations (in particular commercial and accounting), before deletion or anonymisation.',
					'Newsletter subscriptions are kept for as long as you remain subscribed. You can unsubscribe at any time via the link in each email, or by writing to us.',
				],
			},
			{
				title: '7. Your rights',
				paragraphs: [
					'Under Senegalese law no. 2008-12 of 25 January 2008 on the protection of personal data, you may request access, rectification, update or deletion of your data, within the limits provided by law.',
					`To exercise these rights, write to ${settings.email || 'contact@kolokolo.tech'}. You may also contact Senegal’s Commission de protection des données personnelles (CDP).`,
				],
			},
			{
				title: '8. Cookies and trackers',
				paragraphs: [
					'The website may use technical cookies required for it to work (session, security, display preferences). No advertising cookie is set without prior information.',
					'You can configure your browser to refuse cookies. Some website features may then be limited.',
				],
			},
			{
				title: '9. Security',
				paragraphs: [
					'Kolokolo implements reasonable measures to protect your data against unauthorised access, loss or alteration. No system is infallible, so please only send the information needed for your request.',
				],
			},
			{
				title: '10. Updates',
				paragraphs: [
					'This policy may be updated to reflect changes to the website or the law. The date at the top of the page is authoritative.',
				],
				links: [{ href: '/conditions-generales', label: 'See also the terms of use' }],
			},
		],
	};
}

function conditionsGenerales(settings, lang) {
	return lang === 'en' ? conditionsGeneralesEn(settings) : conditionsGeneralesFr(settings);
}

function confidentialite(settings, lang) {
	return lang === 'en' ? confidentialiteEn(settings) : confidentialiteFr(settings);
}

module.exports = { conditionsGenerales, confidentialite };
