<?php

include "application/models/model_token.php";


    function createGeo($token,$name,$num,$coord,$dist) {
        $url = "https://185.250.148.231/addgeo/";

        $postdata = json_encode(array('access'=>$token,"name" => $name,"num" =>$num ,"coord" => $coord,"dist" => $dist));
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }
    session_start();
    $token = $_SESSION['access'];

    $req = new Token();

    $res = json_decode($req->is_valid_token($token), true);
    // print_r($res);
    if (isset($res['error'] )) {
        // echo ('токен сломался,делаем рефреш');
        $resRefresh = json_decode($req->get_access_token($_SESSION["refresh"]), true);
        $_SESSION['access'] = $token;
        $token = $resRefresh['access'];
        // echo ('Рефрешнули токен');
    }
    
    $json = json_decode(file_get_contents('php://input'),true);
    $name = $json["geoName"];
    $num = $json["amounthPoint"];
    $coord = $json["coord"];
    $dist = $json["distancePoint"];


    $res = createGeo($token,$name,$num,$coord,$dist);

    var_dump($res);
    
?>