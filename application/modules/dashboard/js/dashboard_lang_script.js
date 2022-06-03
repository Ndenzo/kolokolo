function translate_content(tnum) {
     $('.lan-text-bil').text(trans_content[0][tnum]);
     $('.lan-text-cas').text(trans_content[1][tnum]);
     $('.lan-text-spe').text(trans_content[2][tnum]);
     $('.lan-text-tur').text(trans_content[3][tnum]);
     $('.lan-text-pet').text(trans_content[4][tnum]);
     $('.lan-text-to-col').text(trans_content[5][tnum]);
     $('.lan-text-to-dis').text(trans_content[6][tnum]);
     $('.lan-text-emp').text(trans_content[7][tnum]);
     $('.lan-text-stu').text(trans_content[8][tnum]);
     $('.lan-text-tut').text(trans_content[9][tnum]);
     $('.lan-text-ren-rat').text(trans_content[10][tnum]);
     $('.lan-text-ren').text(trans_content[11][tnum]);
     $('.lan-text-rat').text(trans_content[12][tnum]);
     $('.lan-text-stu-re-').text(trans_content[13][tnum]);
     $('.lan-text-sch').text(trans_content[14][tnum]);
     $('.lan-text-lat-dis').text(trans_content[15][tnum]);
     $('.lan-text-lat-col').text(trans_content[16][tnum]);
}

var trans_content = [
     { gb : 'Billing', fr : 'Facturation' },
     { gb : 'Cashin', fr : 'Encaissement' },
     { gb : 'Spending', fr : 'Décaissement' },
     { gb : 'Turnover', fr : "Chiffre d'affaire" },
     { gb : 'Petty cash', fr : 'Petite caisse' },
     { gb : 'To day collections', fr : 'Encaissements du jour' },
     { gb : 'To day disbursements', fr : 'Décaissements du jour' },
     { gb : 'Employees', fr : 'Employés' },
     { gb : 'Students', fr : 'Elèves' },
     { gb : 'Tutors', fr : 'Tuteurs' },
     { gb : 'Renewal rate', fr : 'Taux de recouvrement' },
     { gb : 'Renewal', fr : 'Renouvellement' },
     { gb : 'Rate', fr : 'Taux' },
     { gb : 'Students Re-register', fr : 'Elèves Réinscrient' },
     { gb : 'Schooling', fr : 'Scolarité' },
     { gb : 'Latest collections', fr : 'Derniers Encaissements' },
     { gb : 'Latest disbursements', fr : 'Derniers Décaissements' },
];
