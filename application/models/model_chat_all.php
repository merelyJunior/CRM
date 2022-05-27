<?php

class Model_chat_table
{
	public function get_all_datas($token)
	{	
	    $url = "https://185.250.148.231/alldialog/";

        //The data you want to send via POST
        $fields = [
            'access'=> $token
        ];

        //url-ify the data for the POST
        $fields_string = json_encode($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);  

        //execute post
        $result = curl_exec($ch);

        return $result;
	}
    

}
