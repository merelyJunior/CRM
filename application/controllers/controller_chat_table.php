<?php

class Controller_chat_table extends Controller
{

	function __construct()
	{	
		
		$this->model = new Model_Chat_table();
		$this->view = new View();
	}
	
	function action_index()
	{
		$data= json_decode($this->model->get_all_datas($_SESSION['access']), true);
		$this->view->generate( 'dialogue_list_view.php', $data);
	}

}

