<?php
Class LogQueryHook {

    function log_queries() {    
        $CI =& get_instance();
        $times = $CI->db->query_times;
        $dbs    = array();
        $output = NULL;     
        $queries = $CI->db->queries;

        if (count($queries) == 0){
            $output .= "no queries\n";
        }else{
            foreach ($queries as $key=>$query)
            {
                $output .= gmdate('d/m/Y H:i:s'). "-";
                $output .= $query . "\r\n";
            }
            $took = round(doubleval($times[$key]), 3);
            $output .= "===[took:{$took}]\r\n";
        }

        $CI->load->helper('file');
        if ( ! write_file(APPPATH  . "/logs/queries.log.txt", $output, 'a+')){
             log_message('debug','Unable to write query the file');
        }   
    }
}
?>