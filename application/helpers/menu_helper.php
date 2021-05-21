<?php
/**
 * Ibems
 *
 * @package	Ibems Helper
 * @author	Kakou Cyr Leonce Anicet
 * @copyright Copyright (c) 2015, Ibems, Inc.
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://www.ibems.com
 * @since	Version 1.0.0
 * @filesource
 */ 
/*
| -------------------------------------------------------------------
|  UTILS
| -------------------------------------------------------------------
*/

defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('drawSubMenu')){
    function drawSubMenu($menuitems = array(),$active = true)
    {
        $CI = get_instance();
        $module = $CI->router->fetch_module();
        $controllers =  array();
        $icon = @$menuitems['icon'];
        $header = @$menuitems['header'];
        $state = '';
        $items = '';
        $items .= '<ul class="sub-menu">';
        if(isset($menuitems['menuitems']))
        {
            foreach ($menuitems['menuitems'] as $index=>$value)
            {
                $controllers[] = @end(explode('/',$value['controller']));
                $condition = @$value['is_hidden'];
                $url = base_url($value['controller']);
                $class = activeMenu($value['controller'],null,false);
                $name = $value['name'];
                $c_icon = @$value['icon'];
                if($condition!==false)
                {
                    $url = ($active)?$url:'#';
                    $items.="<li class=\"nav-item start {$class}\">";
                    $items.="<a href=\"{$url}\" class=\"nav-link \">";
                    if(!empty($c_icon))
                    {
                        $items.="<i class=\"{$c_icon}\"></i>&nbsp;";
                    }
                    $items.="<span class=\"title\">{$name}</span> </a>";
                    $items.="</li>";
                }
            }
        }
        $items.='</ul>';
        $state = openModuleMenu(array($module),$controllers,false);
        $html = "<li class=\"nav-item {$state}\"> <a href=\"javascript:;\" class=\"nav-link nav-toggle\"> <i class=\"{$icon}\"></i> <span class=\"title\">{$header}</span> <span class=\"arrow\"></span> </a>";
        $html.= $items;
        $html.='</li>';
        return($html);
    }
}

if(!function_exists('openModuleMenu')){
    function openModuleMenu($menuitems = array(), $controllers = null, $output = true)
    {
        $CI = &get_instance();
        $class = '';
        $module = $CI->router->fetch_module();
        $controller =  $CI->router->fetch_class();
        if(!is_null($controllers))
        {
            if(in_array($controller, $controllers)&&in_array($module,$menuitems)) $class = 'open active';

        } elseif(in_array($module,$menuitems)) $class = 'open active';

        if ($output) echo $class; else return($class);
    }
}
if(!function_exists('openControllerMenu')){
    function openControllerMenu($menuitems = array())
    {
        $CI = &get_instance();
		$controller =  $CI->router->fetch_class();
        if(in_array($controller,$menuitems)) echo 'opened expanded ';                                    
    }
}
if(!function_exists('activeMenu')){
    function activeMenu($menuitem, $cond = null,$output = true)
    {
        $CI = &get_instance();
        $module = $CI->router->fetch_module();
		$controller =  $CI->router->fetch_class();
        $menu_item_arr = explode('/',$menuitem);
        if(count($menu_item_arr)>1){
            if($module!=reset($menu_item_arr)||$controller!=end($menu_item_arr))return;            
        }elseif($menuitem!=$controller)return;			
		if(!is_null($cond)&&is_array($cond)){
		  foreach($cond as $k=>$v)if(@$_GET[$k]!=$v) return;          
		}
		if($output) echo ' active '; else return ' active';
    }
}
?>