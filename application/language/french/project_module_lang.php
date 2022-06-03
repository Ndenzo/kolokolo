<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// --------------- Module

$lang['project-title'] = "Projets";

// --------------- Tables

$lang['project-table-label-date'] = "Date";
$lang['project-table-label-project'] = "Projet";
$lang['project-table-label-address'] = "Adresse";
$lang['project-table-label-value'] = "Valeur";
$lang['project-table-label-action'] = "Actions";

$lang['project-table-label-desc'] = "Description";
$lang['project-table-label-struc'] = "Structure";
$lang['project-table-label-period'] = "Période";

// --------------- Headers

$lang['project-header-lock'] = "Bloquer";
$lang['project-header-unlock'] = "Débloquer";
$lang['project-header-delete'] = "Supprimer";

$lang['project-header-project'] = "Projet";
$lang['project-header-desc'] = "Description";
$lang['project-header-location'] = "Localisation";
$lang['project-header-picture'] = "Illustration";
$lang['project-header-gallery'] = "Galerie";
$lang['project-header-charac'] = "Caractéristique";
$lang['project-header-struc'] = "Structures voisines";
$lang['project-header-convenience'] = "Commodités";
$lang['project-header-timeline'] = "Chronologie";
$lang['project-header-disbursal'] = "Décaissement";
$lang['project-header-crop'] = "Recadrer l'image";

$lang['project-header-newTimeline'] = "Ajouter Chronologie";
$lang['project-header-newDisbursal'] = "Ajouter Décaissement";
$lang['project-header-newCharac'] = "Ajouter Characteristique";
$lang['project-header-newStruc'] = "Ajouter Structure";


// --------------- Forms

$lang['project-form-label-name'] = "Nom du projet";
$lang['project-form-placeholder-name'] = "Nom";

$lang['project-form-label-value'] = "Valeur du projet";
$lang['project-form-placeholder-value'] = "Valeur";

$lang['project-form-label-type'] = "Type d'immobilier";

$lang['project-form-label-state'] = "Pays";

$lang['project-form-label-town'] = "Ville";

$lang['project-form-label-address'] = "Adresse du projet";
$lang['project-form-placeholder-address'] = "Adresse";

$lang['project-form-label-lenght'] = "Durée d'investissement";
$lang['project-form-placeholder-lenght'] = "Nombre de mois";

$lang['project-form-label-investDebut'] = "Début d'investissement";

$lang['project-form-label-investRent'] = "Loyer prévisionnel (%)";
$lang['project-form-placeholder-investRent'] = "Pourcentage";

$lang['project-form-label-investReturn'] = "Retour prévisionnel (%)";
$lang['project-form-placeholder-investReturn'] = "Pourcentage";

$lang['project-form-label-rentIncome'] = "Revenus Locatifs (F CFA / M²)";
$lang['project-form-placeholder-rentIncome'] = "Valeur";

// --------------- Notifications

$lang['project-insert-done'] = "Le projet a été enregistrer !";
$lang['project-insert-error'] = "Une erreur s'est produite !";
$lang['project-insert-invest-done'] = "L'investissement a été enregistrer !";
$lang['project-insert-invest-error'] = "Une erreur s'est produite !";
$lang['project-insert-report-done'] = "Le rapport a été enregistrer !";
$lang['project-insert-report-error'] = "Une erreur s'est produite !";
$lang['project-insert-info-done'] = "L'info a été enregistrer !";
$lang['project-insert-info-error'] = "Une erreur s'est produite !";
$lang['project-insert-request-done'] = "La demande a été enregistrer !";
$lang['project-insert-request-error'] = "Une erreur s'est produite !";

$lang['project-update-done'] = "Le projet a été modifier !";
$lang['project-update-error'] = "Une erreur s'est produite !";
$lang['project-update-info-done'] = "L'info a été modifier !";
$lang['project-update-info-error'] = "Une erreur s'est produite !";

$lang['project-locker-done'] = "Le projet a été modifier !";
$lang['project-locker-error'] = "Une erreur s'est produite !";
$lang['project-locker-timeline-done'] = "La timeline a été modifier !";
$lang['project-locker-timeline-error'] = "Une erreur s'est produite !";

$lang['project-delete-done'] = "Le projet a été supprimer !";
$lang['project-delete-error'] = "Une erreur s'est produite !";
$lang['project-delete-picture-done'] = "L'image a été supprimer !";
$lang['project-delete-picture-error'] = "Une erreur s'est produite !";
$lang['project-delete-report-done'] = "Le rapport a été supprimer !";
$lang['project-delete-report-error'] = "Une erreur s'est produite !";
$lang['project-delete-info-done'] = "L'info a été supprimer !";
$lang['project-delete-info-error'] = "Une erreur s'est produite !";
$lang['project-delete-invest-done'] = "L'investissement a été supprimer !";
$lang['project-delete-invest-error'] = "Une erreur s'est produite !";

// --------------- Messages

$lang['project-message-update'] = "Cette opération va changer le statut du projet. <br> Souhaitez-vous continuer ?";
$lang['project-message-delete'] = "Cette opération va supprimer le projet de manière permanante. <br> Souhaitez-vous continuer ?";
$lang['project-message-picture-delete'] = "Cette opération va supprimer l'image de manière permanante. <br> Souhaitez-vous continuer ?";
$lang['project-message-report-delete'] = "Cette opération va supprimer le rapport de manière permanante. <br> Souhaitez-vous continuer ?";
$lang['project-message-info-delete'] = "Cette opération va supprimer l'info de manière permanante. <br> Souhaitez-vous continuer ?";
$lang['project-message-invest-delete'] = "Cette opération va supprimer l'investissement de manière permanante. <br> Souhaitez-vous continuer ?";

$lang['project-message-charac'] = "Ajoutez quelques caractéristiques du projet sous forme de clé valeur. <br> Exemple : <strong>Nombre d'étages </strong> : <strong>7 étages</strong>";
$lang['project-message-struc'] = "Ajoutez quelques structures aux environs du projet ainsi que leur distance approximative. <br> Exemple : <strong>Complexe Saint Michel </strong> : <strong>3 km</strong>";
$lang['project-message-convenience'] = "Ajoutez quelques commodités au projet. <br> Si une commodités n'est pas disponible renseignez là sur le menu <strong>Projet / Commodités </strong>";
$lang['project-message-timeline'] = "Représente le programme du projet dans une période bien définie dans les grandes ligne. <br> Exemple : <strong>Acquisition du terrain</strong> au <strong>08/2022</strong>";
$lang['project-message-disbursal'] = "Représente le programme de décaissement de l'investissement sur le projet dans les grandes ligne en pourcentage. <br> Exemple : <strong>Démarrage des travaux</strong>  <strong>25%</strong>";

$lang['project-message-addValue'] = "Ajoutez une valeur !";

// --------------- Badges
