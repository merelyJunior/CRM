<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route
{
	
	static function start()
	{

		
		include "application/models/model_request.php";
		
		$req = new Model_request();	
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if($_SERVER['REQUEST_URI']=="/index.php"){header("Location: /"); exit;}


		if(($routes[1] == 'chat' || $routes[1] == 'edit_dialogue' || $routes[1] == 'edit_dialogue_view'  ) && isset($routes[2]) && is_numeric($routes[2])) {
			$_REQUEST['dialogIdd'] = $routes[2];
			
			unset($routes[2]);  
		}


		if($routes[1] == 'messages' && isset($routes[2]) && is_numeric($routes[2])) {
			$_REQUEST['messagesId'] = $routes[2];
			
			unset($routes[2]);  
		}
	

		$isAccess = true;
		// контроллер и действие по умолчанию
		$controller_name = 'login';
		$action_name = 'index';
		if (isset($_POST['login']) && isset($_POST['password']) && !isset($_SESSION['access'])){
			$res = json_decode($req->auth($_POST['login'],$_POST['password']), true);
			
			// echo "<script>alert('ERROR2');</script>";
			if (isset($res["error"])) {
				// echo "<script>alert('ERROR');</script>";
			} else {
				$_SESSION["access"] = $res['access'];
				$_SESSION["refresh"] = $res['refresh'];
				$controller_name = 'dialogue';
			}
		}

		$res = json_decode($req->is_valid_token($_SESSION["access"]), true);
		if (isset($res['error'])) {
			// echo "<script>alert('ERROR1');</script>";
			$resRefresh = json_decode($req->get_access_token($_SESSION["refresh"]), true);
			// print_r($resRefresh);
			if(!isset($resRefresh['error'])) {
				$_SESSION["access"] = $resRefresh['access'];
				$controller_name = 'dialogue';
				// echo "<script>alert('ERROR2');</script>";
			} else {
				unset($_SESSION['access']);
				unset($_SESSION['refresh']);
				// echo "<script>alert('Exit!');</script>";
				$isAccess = false;
			}
		} else {
			$controller_name = 'dialogue';
		}
		// получаем имя контроллера
		if ( !empty($routes[1]) && $isAccess)
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}
		
		
		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		/*
		echo "Model: $model_name <br>";
		echo "Controller: $controller_name <br>";
		echo "Action: $action_name <br>";
		*/

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include "application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
