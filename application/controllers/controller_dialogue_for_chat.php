<?php

class Controller_Dialogue_For_Chat extends Controller
{

	function action_index()
	{	
		$this->view->generate('dialogue_for_chat_view.php', 'account_template_view.php');
	}
}

