<?php

// my login in TCXC
$api_login ="ENTER YOUR BUYER USER NAME HERE";

//my API key
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
                
                //...

                );


//query against api. URL
curl_setopt($ch, CURLOPT_URL,"https://members.telecomsxchange.com/$controller.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

//analyze JSON output

echo "$server_output";
?>
