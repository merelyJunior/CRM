<?php

class Controller_Login extends Controller
{

	function action_index()
	{	
		
		$this->view->generate('login_view.php', 'login_template_view.php');
	}
}
