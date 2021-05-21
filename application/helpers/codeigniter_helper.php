<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('select')) {
     function select($select) {
          $request = &get_instance()->db;
          return $request->select($select);
     }
}

if (!function_exists('from')) {
     function from($from) {
          $request = &get_instance()->db;
          return $request->from($form);
     }
}

if (!function_exists('get')) {
     function get($get) {
          $request = &get_instance()->db;
          return $request->get($get);
     }
}

if (!function_exists('where')) {
     function where($where) {
          $request = &get_instance()->db;
          return $request->get($where);
     }
}
