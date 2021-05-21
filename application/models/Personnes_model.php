<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personnes_model extends IBEMS_Model
{
    public $__user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = get_user_info('user_id');
    }

    public function create()
    {

    }
}
?>
