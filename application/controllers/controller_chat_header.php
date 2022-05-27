<?php
include "application/models/model_chat.php";
class Controller_chat_header extends Controller
{
	function __construct()
	{
		$this->model = new Model_chat();
		$this->view = new View();
	}
	
	function action_index()
	{
		$data_ = $this->model->get_datas($_SESSION['access'], isset($_REQUEST['dialogIdd']) ? $_REQUEST['dialogIdd'] : 1, true);
		$data_ = explode('@#@#@#@#@#@#@#@#@', $data_);
		$data[] = json_decode($data_[0], 1);
		$data[] = json_decode($data_[1], 1);
		$this->view->generate( 'test_view.php', 'account_template_view.php', $data);
	}

}
