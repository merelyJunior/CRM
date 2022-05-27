<?php
if(!isset($_POST['event'])) {
	exit('Access denied');
}
session_id($_GET['PHPSESSID']);
session_start();

$url = "https://185.250.148.231/delete/";

if($_POST['event'] === 'delete') {
	$fields = [
		'access'=>$_SESSION['access'],
		'event'=>'deleteMessage',
		'id'=>(int)$_POST['id']
	];
} else
if($_POST['event'] === 'edit') {
	$fields = [
		'access'=>$_SESSION['access'],
		'event'=>'editMessage',
		'id'=>(int)$_POST['id'],
		'message'=>$_POST['message']
	];
} else {
	exit('Access denied');
}
//url-ify the data for the POST
$fields_string = json_encode($fields);
echo $fields_string;
//open connection
$ch = curl_init();
//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//execute post
$result = curl_exec($ch);
//echo $result;