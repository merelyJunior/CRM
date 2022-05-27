<?php

include "application/models/model_token.php";

   function getCount($token) {
        $url = "https://185.250.148.231/dialogcount/";
        $fields = [
            'access'=> $token
        ];
        $fields_string = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        $result = curl_exec($ch);
        return json_decode($result);
    }   

    function sendDialog($token) {
        $url = "https://185.250.148.231/stopreg/";
        $postdata = json_encode(array('access'=>$token));
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
    // var_dump($res);
    if (isset($res["error"])) {
        // echo ('токен сломался,делаем рефреш');
        $resRefresh = json_decode($req->get_access_token($_SESSION["refresh"]), true);
        
        $_SESSION['access'] = $token;
        $token = $resRefresh['access'];
        // var_dump($token);
    }
    $res = sendDialog($token);

    
   
?>