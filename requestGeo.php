<?php

session_start();
$token = $_SESSION['access'];

// Converts it into a PHP object
$statsData = $json;
// print_r($statusCountry);
$url = "https://185.250.148.231/allbotsgeo/";

$postdata = json_encode(array('access'=>$token));
// echo($postdata);
$ch = curl_init($url); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);

$res = json_decode($result, true);
echo(json_encode($res));
// echo(json_encode(['status'=> 'ok','response'=>$result,'error'=>curl_error($ch),'responseCode'=>curl_getinfo($ch, CURLINFO_HTTP_CODE)]));
curl_close($ch);
?>