<?php

class Controller_Stats extends Controller
{
	function __construct()
	{	
		$this->model = new Model_stats();
		$this->view = new View();
	}
	function action_index()
	{	
		$data['lang'] = $this->model->getBotStats($_SESSION['access']);
		$this->view->generate('stats_view.php', 'account_template_view.php',$data);
	}
}
