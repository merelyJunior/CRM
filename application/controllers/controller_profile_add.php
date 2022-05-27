<?php

class Controller_Profile_Add extends Controller
{
	// function __construct()
	// {	
	// 	$this->model = new Model_stats();
	// 	$this->view = new View();
	// }
	function action_index()
	{	
		// $data['lang'] = $this->model->getBotStats($_SESSION['access']);
		$this->view->generate('profile_add_view.php', 'account_template_view.php');
	}
}
