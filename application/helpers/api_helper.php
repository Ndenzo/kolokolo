<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* API helper
* @package		Api Helper
* @subpackage          Helpers
* @auothor	   	Ankit Rajput
* @website		http://www.tekshapers.com
* @company             Tekshapers Inc
* @since		Version 1.0
*/


/**
* call_api
* this function called api functions
* @param mix array $postData
* @param string $route
*
* @return
*/

if (!function_exists('assoc_to_uri')) {
     function assoc_to_uri($args)
     {
          $CI = &get_instance();
          return $CI->uri->assoc_to_uri($args);
     }
}
if (!function_exists('call_api')) {
     function call_api($route,$method, $postData = array())
     {
          $CI       = &get_instance();    // create instance of CI
          $XSecret  = @$CI->config->item('X-Secret');   // GET auth key value from config file
          $api_url  = @$CI->config->item('api_url');   // GET auth key value from config file
          $token    = me('token');
          $query_string = '';
          $url = $api_url.$route;  // initialize URL for Api
          if(is_array($postData))
          {
               $query_string = http_build_query($postData);
          }
          ////$postData['route']      =   $route;
          $headers = array();
          $headers[] = 'X-Secret: '.$XSecret;
          $headers[] = 'debug: false';
          $headers[] = 'Accept-Language: FR';
          $headers[] = 'Content-Type: application/json';
          $headers[] = 'Accept: application/json';
          $headers[] = 'Authorization-Token: '.$token;
          if(in_array(strtoupper($method),array('POST','PUT','DELETE'))&& is_array($postData))
          {
               $headers[] = 'Content-Length: ' . strlen($query_string);
          }
          try {
               $curl = curl_init();
               switch (strtoupper($method))
               {
                    case 'POST':
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $query_string);
                    break;
                    case 'GET':
                    $url.'?'.$query_string;
                    break;
                    case 'PUT':
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                    curl_setopt($curl, CURLOPT_PUT, true);
                    break;
                    case "DELETE":
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $query_string);
                    break;
                    default:
               }
               //setting url
               curl_setopt($curl, CURLOPT_URL, $url);
               //Ignore SSL certificate verification
               curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
               curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
               // set URL and other appropriate options
               //curl_setopt($curl, CURLOPT_FAILONERROR, false);
               curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
               curl_setopt($curl, CURLOPT_HEADER, false);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($curl, CURLOPT_TIMEOUT, 500);
               curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
               if (!$result = curl_exec($curl))
               {
                    die('API Call Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
               }
               curl_close($curl);
               return (trim($result));

          } catch (Exception $e) {
               throw new Exception($e);
          }
          exit(0);
     }
}

if (!function_exists('zoom_users')) {
     function zoom_users(){
          $curl = curl_init();

          curl_setopt_array($curl, array(
               CURLOPT_URL => "https://api.zoom.us/v2/users?status=active&page_size=30&page_number=1",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "GET",
               CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer ". config('zoom_token'),
                    "content-type: application/json"
               ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
               echo "cURL Error #:" . $err;
          } else {
               echo $response;
          }
     }
}


if (!function_exists('zoom_create_user')) {
     function zoom_create_user($data){
          $curl = curl_init();

          $postfields = array(
               "action"=> "create",
               "user_info"=> array(
                    "email"=> $data['user_email'],
                    "first_name"=> $data['person_first_name'],
                    "last_name"=> $data['person_last_name'],
                    "type"=> 1,
               ),
          );

          curl_setopt_array($curl, array(
               CURLOPT_URL => "https://api.zoom.us/v2/users",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => json_encode($postfields),
               CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer ". config('zoom_token'),
                    "content-type: application/json"
               ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
               echo "cURL Error #:" . $err;
          } else {
               return $response;
          }
     }
}

if (!function_exists('zoom_create_meeting')) {
     function zoom_create_meeting($data, $topic){
          $curl = curl_init();

          $postfields = array(
               "created_at"=> gmdate('Y-m-d')."T".gmdate('H:i:s')."Z",
               "duration"=> 60,
               "id"=> 1100000,
               "join_url"=> "https://zoom.us/j/1100000",
               "settings"=> array(
                    "alternative_hosts"=> "",
                    "approval_type"=> 2,
                    "audio"=> "both",
                    "auto_recording"=> "local",
                    "close_registration"=> false,
                    "cn_meeting"=> false,
                    "enforce_login"=> false,
                    "enforce_login_domains"=> "",
                    "host_video"=> false,
                    "in_meeting"=> false,
                    "join_before_host"=> true,
                    "mute_upon_entry"=> false,
                    "participant_video"=> false,
                    "registrants_confirmation_email"=> true,
                    "use_pmi"=> false,
                    "waiting_room"=> false,
                    "watermark"=> false,
                    "registrants_email_notification"=> true
               ),
               "start_time"=> $data->customer_schedule_date."T".$data->schedule_time."Z",
               "start_url"=> "https://zoom.us/s/1100000?iIifQ.wfY2ldlb82SWo3TsR77lBiJjR53TNeFUiKbLyCvZZjw",
               "status"=> "waiting",
               "timezone"=> $data->settings_timezone_name,
               "topic"=> $topic,
               "type"=> 2,
          );

          curl_setopt_array($curl, array(
               CURLOPT_URL => "https://api.zoom.us/v2/users/6L-g3Eh4TCSA_2ZD1HVpiQ/meetings",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => json_encode($postfields),
               CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer ". config('zoom_token'),
                    "content-type: application/json"
               ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
               echo "cURL Error #:" . $err;
          } else {
               return $response;
          }
     }
}

if (!function_exists('zoom_delete_meeting')) {
     function zoom_delete_meeting($meeting_id){
          $curl = curl_init();

          curl_setopt_array($curl, array(
               CURLOPT_URL => "https://api.zoom.us/v2/meetings/".$meeting_id,
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 30,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "GET",
               CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer ". config('zoom_token'),
                    "content-type: application/json"
               ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
               echo "cURL Error #:" . $err;
          } else {
               echo $response;
          }
     }
}
?>
