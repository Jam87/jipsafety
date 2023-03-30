<?php
### CLASE USUARIO ###
class Usuarios extends Controllers
{

    public function __construct()
    {
        session_start(); #Inicio sesion
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
        parent::__construct();
    }

    ### CONTROLADOR: CARGAR VISTA Y DATA ###
    public function Usuarios()
    {
        $data['page_title'] = "Jipsafety | Categoria";
        $data['page_name'] = "Usuarios";
        $data['description'] = "";
        $data['breadcrumb-item'] = "Usuarios";
        $data['breadcrumb-activo'] = "Usuario";
        $data['page_functions_js'] = "functions_usuario.js";

        #Data modal
        $data['page_title_modal'] = "Nuevo tipo de usuario";
        $data['page_title_bold'] = "Estimado usuario";
        $data['descrption_modal1'] = "Los campos remarcados con";
        $data['descrption_modal2'] = "son necesarios.";

        $data['btn_title_principal'] = "Nuevo usuario.";
        $data['data-sidebar-size'] = 'sm';

        #Cargo la vista(usuario). 
        $this->views->getView($this, "usuarios", $data);
    }

    ### CONTROLADOR: OBTENER INFORMACION COMBOX TIPO USUARIO ###
    function obtenerTipoUsuario()
    {

        #Modelo comboxTipoUsuario
        $arrData = $this->model->comboxTipoUsuario();

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        exit();
    }

    ### CONTROLADOR: MOSTRAR TODOS LOS USUARIO EN EL DATATABLE ###
    public function getUsuarios()
    {
        $arrData = $this->model->selectUsuario();

        /*var_dump($arrData);
        exit();*/

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['activo'] == 1) {
                $arrData[$i]['activo'] = '<span class="badge rounded-pill bg-success">Activo</span>';
            } else {
                $arrData[$i]['activo'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
            }

            #Botones
            $arrData[$i]['options'] = '<div class="text-center">
				<button type="button" class="btn btn-warning btn-sm btnEditTipo" onClick="fntEditUsuario(' . $arrData[$i]['cod_usuario'] . ')" title="Editar"><i class="ri-edit-2-line"></i></button>
				<button type="button" class="btn btn-danger btn-sm btnDelTipo" onClick="fntDelUsuario(' . $arrData[$i]['cod_usuario'] . ')" title="Eliminar"><i class="ri-delete-bin-5-line"></i></button>
				</div>';
        }


        #JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        exit();
    }

    ### CONTROLADOR: GUARDAR USUARIO ###
    public function setUsuarios()
    {

        /* var_dump($_POST);
        exit();*/

        if ($_POST) {

            #Verifico
            if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo']) || empty($_POST['lStatus']) || empty($_POST['Tusuario'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.'); #No se envian los datos correspondientes

            } else {
                #Si es true
                #Capturo los datos
                #-intIdUsuario: Cuando de clic en Editar
                #-strClean:Limpio campos
                #-ucwords:Convierte las 1 letras mayusculas
                #-strtolower:Convierte a minuscula
                $intIdUsuario = intval($_POST['idUsuario']);

                $nombre = ucwords(strClean($_POST['nombre']));
                $apellido = ucwords(strClean($_POST['apellido']));
                $correo = strtolower(strClean($_POST['correo']));
                $username = strClean($_POST['username']);
                $telefono = strClean($_POST['telefono']);
                $txtDescription = strClean($_POST['txtDescription']);
                $lStatus = intval($_POST['lStatus']);
                $Tusuario = intval($_POST['Tusuario']);
                $strPassword = empty($_POST['password']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['password']);
            }


            #Si no viene ningun ID - Es porque voy a crear un 1 nuevo usuario
            if ($intIdUsuario == 0) {

                #Crear
                $request_Usuario = $this->model->insertUsuario(
                    $nombre,
                    $apellido,
                    $correo,
                    $username,
                    $telefono,
                    $strPassword,
                    $txtDescription,
                    $lStatus,
                    $Tusuario
                );
                $option = 1;
            } else {

                #Actualizar
                $request_Usuario = $this->model->updateUsuario(
                    $intIdUsuario,
                    $nombre,
                    $apellido,
                    $correo,
                    $username,
                    $telefono,
                    $strPassword,
                    $txtDescription,
                    $lStatus,
                    $Tusuario
                );
                $option = 2;
            }


            if ($request_Usuario > 0) {
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente');
            }

            #Convierto .json
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    ### CONTROLADOR: ELIMINAR TIPO DE USUARIO ###
    public function delUsuario()
    {
        if ($_POST) {

            $intIdUsuario = intval($_POST['cod_usuario']);

            $requestDelete = $this->model->delUsuario($intIdUsuario);

            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            die();
        }
    }

    ### CONTROLADOR: EDITAR TIPO DE USUARIO ###    
    public function getUsuario(int $idUsuario)
    {

        $intIdUsuario = intval(strClean($idUsuario));

        if ($intIdUsuario > 0) {
            $arrData = $this->model->editUsuario($intIdUsuario);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
