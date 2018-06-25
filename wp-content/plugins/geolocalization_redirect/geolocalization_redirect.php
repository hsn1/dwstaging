<?php
   /*
   Plugin Name: geolocalization_redirect
   Plugin URI: http://datawinners.com
   Description: A plugin that localize a device and redirect to the corresponding language
   Version: 1.0
   Author: Hasina
   License: GPL2
   */
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

$PublicIP = get_client_ip(); 
$json  = file_get_contents("https://freegeoip.net/json/$PublicIP");
$json  =  json_decode($json ,true);
$country =  $json['country_name'];
$region= $json['region_name'];
$city = $json['city'];
session_start();

//echo "country:".$country." region:".$region." city:".$city;
//echo "##########";
//echo $_SESSION['geolocalization_redirect'];
if(!isset($_SESSION['geolocalization_redirect']))
{
  if($country == 'Madagascar')
  {
    //echo "hehe country";
    //echo "</br>";
    $_SESSION['geolocalization_redirect'] = 'mg';
    //echo "enter is home";
    //echo "</br>";
    if(is_home())
    {
      //echo " is home";
      //echo "</br>";
      header("Location: http://mg.321online.org/");
      exit();
    } 
  } 
}
  
