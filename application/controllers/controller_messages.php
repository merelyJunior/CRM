<?php

class Controller_Messages extends Controller
{
	function __construct()
	{	
		$this->model = new Model_messages();
		$this->view = new View();
	}
	function action_index()
	{	
		// $data['lastDialogs'] = $this->model->getAllMessages($_SESSION['access']);
		$data['lang'] = $this->model->getBotStatus($_SESSION['access']);
		
		$data['cur_chat'] = isset($_REQUEST['messagesId']) ? $_REQUEST['messagesId'] : 0;
		
		$this->view->generate('messages_view.php', 'account_template_view.php',$data);
	}
}