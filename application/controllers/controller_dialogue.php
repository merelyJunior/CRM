<?php

class Controller_Dialogue extends Controller
{

	function action_index()
	{	
		$this->view->generate('dialogue_view.php', 'account_template_view.php');
	}
}

