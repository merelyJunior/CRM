<?php

class Controller_Launch extends Controller
{
	// function __construct()
	// {	
	// 	$this->model = new Model_stats();
	// 	$this->view = new View();
	// }
	function action_index()
	{	
		// $data['lang'] = $this->model->getBotStats($_SESSION['access']);
		$this->view->generate('launch_view.php', 'account_template_view.php');
	}
}
