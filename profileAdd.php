<?php
        include "application/models/model_token.php";
        
        function dialogByTime($token,$arr,$lang) {
            $url = "https://185.250.148.231/addabout/";
            $postdata = json_encode(array('access'=>$token,"arr"=>$arr,"lang"=>$lang));
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
        session_write_close();

        $res = json_decode($req->is_valid_token($token), true);
        if (isset($res['error'] )) {
            // echo ('токен сломался,делаем рефреш');
            $resRefresh = json_decode($req->get_access_token($_SESSION["refresh"]), true);
            $_SESSION['access'] = $token;
            $token = $resRefresh['access'];
            // echo ('Рефрешнули токен');
        }

        $json = file_get_contents('php://input');
        $arr = $json;
        $lang= 'en';
        $res = dialogByTime($token, $arr,$lang);
        echo(json_encode($res));
        // print_r($json);
    ?>

  