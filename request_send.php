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

    function sendDialog($token,$dialog1) {
        $url = "https://185.250.148.231/senddialog/";
        $postdata = json_encode(array('access'=>$token,"dialog" => json_decode($dialog1)));
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
    
    $json = file_get_contents('php://input');


    $dialogueEdit = $json;
    $res = sendDialog($token,$dialogueEdit);
    $count = getCount($token); 
    
    $s = $count->ids[count($count->ids)-1];
    print_r($res);
    // echo json_encode(["link" => "chat/$s"]);
    
    // echo(json_encode(['status'=> 'ok','response'=>$result,'error'=>curl_error($ch),'responseCode'=>curl_getinfo($ch, CURLINFO_HTTP_CODE), 'lastId'=>$count]));
?>