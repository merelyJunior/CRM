<?php

class Model_chat extends Model
{
	public function get_datas($token, $id, $getAllDatas = false)
	{	
        
		require_once('model_chat_all.php');
		$model = new Model_Chat_table(); 
		$res = $model->get_all_datas($token);

	    $url = "https://185.250.148.231/dialog/";

        //The data you want to send via POST  
        $fields = [
            'access'=> $token,
            'id'=> $id
        ];
        //url-ify the data for the POST
        $fields_string = json_encode($fields);
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        //execute post
        $result = curl_exec($ch);
        $l = json_decode($result);

        if ($l->exception) {

            header("Location: https://crm.crazybot.net/edit_dialogue/3"); 
            exit();

        }

        return "{$res}@#@#@#@#@#@#@#@#@{$result}";
	}
    

}
