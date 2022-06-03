
function translate(tnum) {
     $('.lan-menu-header-1').text(trans_header[0][tnum]);
     $('.lan-menu-header-2').text(trans_header[1][tnum]);
     $('.lan-menu-header-3').text(trans_header[2][tnum]);
     $('.lan-menu-header-4').text(trans_header[3][tnum]);

     $('.lan-menu-header-desc-1').text(trans_header_desc[0][tnum]);
     $('.lan-menu-header-desc-2').text(trans_header_desc[1][tnum]);
     $('.lan-menu-header-desc-3').text(trans_header_desc[2][tnum]);
     $('.lan-menu-header-desc-4').text(trans_header_desc[3][tnum]);

     $('.lan-menu-1').text(trans[0][tnum]);
     $('.lan-menu-2').text(trans[1][tnum]);
     $('.lan-menu-3').text(trans[2][tnum]);
     $('.lan-menu-4').text(trans[3][tnum]);
     $('.lan-menu-5').text(trans[4][tnum]);
     $('.lan-menu-6').text(trans[5][tnum]);
     $('.lan-menu-7').text(trans[6][tnum]);
     $('.lan-menu-8').text(trans[7][tnum]);

     $('.lan-text-stu').text(trans_sub[0][tnum]);
     $('.lan-text-tut').text(trans_sub[1][tnum]);
     $('.lan-text-emp').text(trans_sub[2][tnum]);
     $('.lan-text-abs').text(trans_sub[3][tnum]);
     $('.lan-text-bilg').text(trans_sub[4][tnum]);
     $('.lan-text-col').text(trans_sub[5][tnum]);
     $('.lan-text-cou').text(trans_sub[6][tnum]);
     $('.lan-text-dis').text(trans_sub[7][tnum]);
     $('.lan-text-rep').text(trans_sub[8][tnum]);
     $('.lan-text-eva').text(trans_sub[9][tnum]);
     $('.lan-text-pri').text(trans_sub[10][tnum]);
     $('.lan-text-rat').text(trans_sub[11][tnum]);
     $('.lan-text-rol').text(trans_sub[12][tnum]);
     $('.lan-text-use').text(trans_sub[13][tnum]);
     $('.lan-text-con').text(trans_sub[14][tnum]);
     $('.lan-text-gen').text(trans_sub[15][tnum]);
     $('.lan-text-pay').text(trans_sub[16][tnum]);
     $('.lan-text-cyc').text(trans_sub[17][tnum]);
     $('.lan-text-mat').text(trans_sub[18][tnum]);
     $('.lan-text-mat-typ').text(trans_sub[19][tnum]);
     $('.lan-text-ope').text(trans_sub[20][tnum]);
     $('.lan-text-sch').text(trans_sub[21][tnum]);
     $('.lan-text-act').text(trans_sub[22][tnum]);
     $('.lan-text-fla').text(trans_sub[23][tnum]);
     $('.lan-text-bil').text(trans_sub[24][tnum]);
}

var trans_header = [{
     gb : 'General',
     fr : 'Général'
}, {
     gb : 'Schooling',
     fr : "Scolarité"
}, {
     gb : 'Configurations',
     fr : 'Configurations',
}, {
     gb : 'Account',
     fr : 'Compte',
}
];

var trans_header_desc = [{
     gb : 'Dashboard, Actors manager',
     fr : 'Tableaux de bord, Gestion des acteurs'
}, {
     gb : 'Schooling, Classes manager',
     fr : "Scolarité, Gestion des classes"
}, {
     gb : 'Security and Settings',
     fr : 'Sécurité et Paramètrages',
}, {
     gb : 'Profile and Log out',
     fr : 'Profil et Déconnection',
}
];


var trans = [{
     gb : 'Dashboard',
     fr : 'Tableaux de bord'
}, {
     gb : 'Actors',
     fr : "Acteurs"
}, {
     gb : 'Classes',
     fr : 'Classes',
}, {
     gb : 'Schooling',
     fr : 'Scolarité',
}, {
     gb : 'Security',
     fr : 'Sécurité'
}, {
     gb : 'Settings',
     fr : "Paramètres"
}, {
     gb : 'Profile',
     fr : 'Profil',
}, {
     gb : 'Log Out',
     fr : 'Déconnection',
}
];

var trans_sub = [
     { gb : 'Students', fr : 'Eleves' },
     { gb : 'Tutors', fr : 'Tuteurs' },
     { gb : 'Employees', fr : 'Employés' },
     { gb : 'Absence and Delay', fr : 'Absences et Retards' },
     { gb : 'Billing', fr : 'Facturations' },
     { gb : 'Collections', fr : 'Encaissements' },
     { gb : 'Course material', fr : 'Supports de cours' },
     { gb : 'Disbursement', fr : 'Décaissements' },
     { gb : 'Reporting', fr : 'Rapports' },
     { gb : 'Evaluation', fr : 'Evaluations' },
     { gb : 'Pricing', fr : 'Tarifications' },
     { gb : 'Rating', fr : 'Notations' },
     { gb : 'Roles', fr : 'Rôles' },
     { gb : 'Users', fr : 'Utilisateurs' },
     { gb : 'Configuration', fr : 'Configurations' },
     { gb : 'General settings', fr : 'Paramètres Généraux' },
     { gb : 'Payment method', fr : 'Méthodes de Paiement' },
     { gb : 'Cycle', fr : 'Cycle' },
     { gb : 'Materials', fr : 'Matières' },
     { gb : 'Materials types', fr : 'Type de Matières' },
     { gb : 'Opendays', fr : 'Jours Ouvrables' },
     { gb : 'Schooling', fr : 'Scolarités' },
     { gb : 'Activity', fr : 'Activités' },
     { gb : 'Flags Settings', fr : 'Gestions des Flags' },
     { gb : 'Bills', fr : 'Factures' },
];
