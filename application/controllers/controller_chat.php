<?php

class Controller_chat extends Controller
{

	function __construct()
	{
		$this->model = new Model_Chat();
		$this->view = new View();
	}
	
	function action_index()
	{
		$data_ = $this->model->get_datas($_SESSION['access'], isset($_REQUEST['dialogIdd']) ? $_REQUEST['dialogIdd'] : 3, true);
		$data_ = explode('@#@#@#@#@#@#@#@#@', $data_);
		$data[] = json_decode($data_[0], 1);
		$data[] = json_decode($data_[1], 1);
		$this->view->generate( 'chat_view.php', 'account_template_view.php', $data);
	}

}
  
 