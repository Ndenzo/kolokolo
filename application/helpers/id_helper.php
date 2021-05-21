<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_from')) {
    function get_from($table, $column, $identifier, $identifier_value) {
        $request = &get_instance()->db;
        $request->select($column);
        $request->from($table);
        $request->where($identifier, $identifier_value);
        $request->get();
        qry_debug();
        return $request->get()->result();
    }
}
