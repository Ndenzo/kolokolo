const defaultTestimonials = [
	{
		name: 'Omar Diallo',
		role: 'Fondateur, startup basée à Seattle',
		content: "L'équipe de Kolokolo est super, surtout dynamique, on y arrive avec un projet fou en tête et il vous aide à mettre de l'ordre dans tout ça.",
		photo: '/assets/front/img/testimonial/test1.png',
		rating: 5,
		sort_order: 1,
		is_active: 1,
	},
	{
		name: 'Ousmane Diouf',
		role: "Directeur, plateforme d'investissement à Dakar",
		content: "J'ai travaillé avec Kolokolo dans le cadre de la mise en place de notre plateforme investisseur, le travail est propre et bien fait, l'accompagnement est continu, je recommande.",
		photo: '/assets/front/img/testimonial/test2.png',
		rating: 5,
		sort_order: 2,
		is_active: 1,
	},
];

const defaultProjects = [
	{
		title: 'site vitrine sur-mesure',
		category: 'Site Web',
		image: '/assets/front/img/portfolio/port1.jpg',
		link: '',
		sort_order: 1,
		is_active: 1,
	},
	{
		title: 'site e-commerce',
		category: 'Site Web',
		image: '/assets/front/img/portfolio/port2.jpg',
		link: '',
		sort_order: 2,
		is_active: 1,
	},
	{
		title: 'application mobile',
		category: 'Mobile App',
		image: '/assets/front/img/portfolio/port3.jpg',
		link: '',
		sort_order: 3,
		is_active: 1,
	},
	{
		title: 'campagne publicitaire',
		category: 'Publicité Digitale',
		image: '/assets/front/img/portfolio/port1.jpg',
		link: '',
		sort_order: 4,
		is_active: 1,
	},
	{
		title: 'gestion réseaux sociaux',
		category: 'Social Media',
		image: '/assets/front/img/portfolio/port2.jpg',
		link: '',
		sort_order: 5,
		is_active: 1,
	},
	{
		title: 'boost publicitaire e-commerce',
		category: 'Publicité Digitale',
		image: '/assets/front/img/portfolio/port3.jpg',
		link: '',
		sort_order: 6,
		is_active: 1,
	},
];

const defaultClientLogos = [
	{
		name: 'Client 1',
		url: '',
		logo_color: '/assets/front/img/brand/brand1.png',
		logo_mono: '/assets/front/img/brand/brand1-wc.png',
		sort_order: 1,
		is_active: 1,
	},
	{
		name: 'Client 2',
		url: '',
		logo_color: '/assets/front/img/brand/brand2.png',
		logo_mono: '/assets/front/img/brand/brand2-wc.png',
		sort_order: 2,
		is_active: 1,
	},
	{
		name: 'Client 3',
		url: '',
		logo_color: '/assets/front/img/brand/brand3.png',
		logo_mono: '/assets/front/img/brand/brand3-wc.png',
		sort_order: 3,
		is_active: 1,
	},
	{
		name: 'Client 4',
		url: '',
		logo_color: '/assets/front/img/brand/brand4.png',
		logo_mono: '/assets/front/img/brand/brand4-wc.png',
		sort_order: 4,
		is_active: 1,
	},
	{
		name: 'Client 5',
		url: '',
		logo_color: '/assets/front/img/brand/brand5.png',
		logo_mono: '/assets/front/img/brand/brand5-wc.png',
		sort_order: 5,
		is_active: 1,
	},
];

module.exports = { defaultTestimonials, defaultProjects, defaultClientLogos };
