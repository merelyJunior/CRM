<?php

class Controller_Bot_Chart extends Controller
{
	function __construct()
	{	
		$this->model = new Model_bot_status();						
		$this->view = new View();
	}
	function action_index()
	{	
		$data['lang'] = $this->model->getBotStatus($_SESSION['access']);
		$data['bots'] = $this->model->get_all_bot_status($_SESSION['access']);
		$this->view->generate('bot_chart_view.php', 'account_template_view.php',$data);
	}
}