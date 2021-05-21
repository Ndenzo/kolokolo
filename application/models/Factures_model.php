<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Factures_model extends IBEMS_Model
{
    public $user_id;
    public $annee;
    public $main_db;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = get_user_info('user_id');
        $this->annee = get_current_annee();
        $this->main_db = get_main_db();
    }
}
?>