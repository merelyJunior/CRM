<?php

class Controller_Reg extends Controller
{
	function __construct()
	{	
		$this->model = new Model_reg();
		$this->view = new View();
	}
	function action_index()
	{	
		$data= $this->model->get_reg_stata($_SESSION['access']);
		$this->view->generate('reg_view.php', 'account_template_view.php',$data);
	}
}
