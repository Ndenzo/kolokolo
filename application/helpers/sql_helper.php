<?php
/**
 * CodeIgniter
 *
 * @package	CodeIgniter
 * @author	Kakou Cyr Leonce Anicet
 * @copyright Copyright (c) 2015, Ibems, Inc.
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://www.ibems.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*PACKS*/
if (!function_exists('sql_list_pack_for')) {
    function sql_list_pack_for($code) {
        $sql = "SELECT pack_id, pack_libelle
                  FROM packs
             LEFT JOIN settings_type_packs ON (settings_type_packs.type_pack_id = packs.type_pack_id)
                 WHERE LOWER(type_pack_code) = '{$code}'";
        return ($sql);
    }
}
//sql_pack_option
if (!function_exists('sql_pack_option')) {
    function sql_pack_option($type_pack_code) {
        $type_pack_code = strtolower($type_pack_code);
        $sql = "SELECT option_id, option_libelle
                  FROM settings_pack_options
             LEFT JOIN settings_type_packs ON (settings_type_packs.type_pack_id = settings_pack_options.type_pack_id)
                 WHERE LOWER(type_pack_code) = '{$type_pack_code}'";

        return ($sql);
    }
}
//sql_type_pack
if (!function_exists('sql_type_pack')) {
    function sql_type_pack() {
        $sql = "SELECT type_pack_id, type_pack_libelle
                  FROM settings_type_packs";
        return ($sql);
    }
}
//sql_pack_relance
if (!function_exists('sql_pack_relance')) {
    function sql_pack_relance($type_pack_id) {
        $type_pack_id = (int)$type_pack_id;
        $sql = "SELECT relance_jour, relance_libelle
                  FROM settings_relances
                  WHERE type_pack_id = $type_pack_id";
        return ($sql);
    }
}
//DISTRIBUTEUR
if (!function_exists('sql_distributeur_produit')) {
    function sql_distributeur_produit($distributeur_id, $vendeur_id) {
        $sql = "SELECT DISTINCT distributeurs_produits.produit_id, packs.pack_libelle
                  FROM packs
             LEFT JOIN distributeurs_produits ON (distributeurs_produits.pack_id = packs.pack_id)
             LEFT JOIN distributeurs ON (distributeurs_produits.pack_id = packs.pack_id)
             LEFT JOIN vendeurs_produit ON (vendeurs_produit.produit_id = distributeurs_produits.produit_id)
                 WHERE distributeurs_produits.distributeur_id = $distributeur_id
            	  AND distributeurs_produits.produit_id not in (SELECT produit_id FROM vendeurs_produit WHERE vendeurs_produit.vendeur_id = $vendeur_id)";
        return ($sql);
    }
}
//LISTE DES POINTS DE VENTE
if (!function_exists('sql_liste_points_de_vente')) {
    function sql_liste_points_de_vente($distributeur_id) {
        $DB = &get_instance()->db;
        $distributeur_id = (int)$distributeur_id;
        $sql = "SELECT point_vente_id, point_vente_libelle
            FROM distributeurs_points_de_vente
            WHERE distributeur_id = $distributeur_id";
        return ($sql);
    }
}
//LISTE DES VILLES
if (!function_exists('sql_liste_ville')) {
    function sql_liste_ville($iso2) {
        $DB = &get_instance()->db;
        $iso2 = $DB->escape_str($iso2);
        $sql = "SELECT ville_libelle, ville_libelle FROM settings_villes WHERE pays_code = '$iso2'";
        return ($sql);
    }
}
?>
