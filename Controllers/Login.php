<?php

class Login extends Controllers
{
	public function __construct()
	{
		session_start();#Inicio sesion
		if(isset($_SESSION['login']))
		{
				header('Location: '.base_url().'/dashboard');	
		}
		parent::__construct();
	}

	public function Login()
	{
		$data['page_id'] = 1;
		$data['page_tag'] = "Login";
		$data['page_title'] = "Consultores en avaluo";
		$data['page_empresa'] = "CAVE";
		$data['page_name'] = "login";
		$data['page_functions_js'] = "functions_login.js";
		$data['page_content'] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, quis.";
		$this->views->getView($this, "login", $data);
	}

	public function loginUser()
	{
		/*dep($_POST);
		die();*/

		if($_POST){
			if(empty($_POST['useremail']) || empty($_POST['userpassword'])){
				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			}else{
				$correo = strtolower(strClean($_POST['useremail']));
				$password = hash("SHA256", $_POST['userpassword']);
				$requestUser = $this->model->loginUser($correo, $password);

				if(empty($requestUser)){
					$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.');
				}else{
					$arrData = $requestUser;
					
					if($arrData['activo'] == 1){
						#Variables sesion
						$_SESSION['idUser'] = $arrData['cod_usuario'];
						$_SESSION['login'] = true;
						$arrResponse = array('status' => true, 'msg' => 'ok');

					}else{
						$arrResponse = array('status' => 'Usuario inactivo');
					}
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

		}
		die();
	}
}
