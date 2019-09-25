<?php
// TCXC Buyer Username
$api_login ="ENTER YOUR BUYER USER NAME HERE";

//API key
$api_key = "ENTER YOUR BUYER API KEY";

// initialising CURL
$ch = curl_init();

//controller is a script name, so in case lookup.php controller is lookup
$controller = "lookup";

//unix timestamp to ensure that signature will be valid temporary
$ts = time();

//compose signature concatenating controller api_key api_login and unix timestamp
$signature = hash( 'sha256', $controller .  $api_key   . $api_login  . $ts);

$params = array(
                'ts' => $ts,  //provide TS
                'signature' => $signature,
                'api_login' => $api_login,
                'webapi' => '1',        // required field
                'prefix' => '962',      // same parameters as web portal accepts
                'searchform' => '1', // same parameters as web portal accepts
                'type' => 'CLI',        // same parameters as web portal accepts
 		            
  
                  /*
                  
                   "pager" &  "off"	required	
                   “pager” and “off” (should be set or unset both) allow to limit and paginate results. 
                   "pager” is a limit of the numbers to be returned, “off” is offset.
                   
                  */
  
                'pager' => 3,
                'off' => 11               
                //...

                );


//query against api. URL
curl_setopt($ch, CURLOPT_URL,"https://api.telecomsxchange.com/$controller.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

//analyze JSON output

echo "$server_output";

/* 

Sample Response - JSON

{
    "status": "success",
    "rates": [
        {
            "prefix": "96278",
            "vendor_name": "IDT",
            "connection_name": "Platinum CLI",
            "i_tariff": "317",
            "daily_asr": 14.5228,
            "weekly_asr": 36.0399,
            "daily_acd": 209,
            "weekly_acd": 169,
            "daily_minutes": 122,
            "weekly_minutes": 712,
            "stats_time": "2019-09-24 03:04:38",
            "i_connection": "315",
            "effective_from": "09\/14\/19 2:41PM",
            "price_1": "0.148000",
            "price_n": "0.148000",
            "interval_1": "1",
            "interval_n": "1",
            "i_vendor": "223",
            "capacity_limit": "1500",
            "i_rate": "113424479",
            "forbidden": "0",
            "discontinued": "0",
            "route_type": "CLI",
            "seller_registration_date": "2014-11-08 20:29:04",
            "country_code": "jo",
            "country_name": "Jordan",
            "description": "Mobile - Umniah",
            "commision_percent": "0",
            "mccmnc": "41603",
            "seller_avg_rating": 3,
            "seller_reviews": 4,
            "rateid": 113424479
        }, */

?>
