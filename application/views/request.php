<?php
if(!isset($_POST['event'])) {
	$url = "https://185.250.148.231/senddialog/";
	$fields_string = file_get_contents('php://input');
} else
if($_POST['event'] === 'edit') {
	$url = "https://185.250.148.231/editdialog/";
	$fields_string = $_POST['json'];
} else
if($_POST['event'] === 'delete') {
	$url = "https://185.250.148.231/delete/";
	$fields_string = "id={$_POST['id']}";
}
//file_put_contents('test.txt', $url."\r\n".$fields_string);
//open connection
$ch = curl_init();
//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//execute post
$result = curl_exec($ch);
curl_close($ch);
return $result;