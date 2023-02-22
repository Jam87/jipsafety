<?php

class Tipos extends Controllers
{

    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
        parent::__construct();
    }

    ### CARGAR VISTA Y DATA ###
    public function Tipos()
    {
        $data['page_title'] = "Jipsafety | Categoria";
        $data['page_name'] = "Tipo de usuarios";
        $data['description'] = "";
        $data['breadcrumb-item'] = "Usuarios";
        $data['breadcrumb-activo'] = "Usuario";
        $data['page_functions_js'] = "functions_tipos.js";

        #Data modal
        $data['page_title_modal'] = "Nuevo tipo de usuario";
        $data['page_title_bold'] = "Estimado usuario";
        $data['descrption_modal1'] = "Los campos remarcados con";
        $data['descrption_modal2'] = "son necesarios.";

        $this->views->getView($this, "tipos", $data);
    }

    ### CARGAR VISTA Y DATA ###
    public function getTipos()
    {
        $arrData = $this->model->selectTipo();

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['activo'] == 1) {
                $arrData[$i]['activo'] = '<span class="badge rounded-pill bg-success">Activo</span>';
            } else {
                $arrData[$i]['activo'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
            }

            #Botones
            $arrData[$i]['options'] = '<div class="text-center">
				<button type="button" class="btn btn-warning btn-sm btnEditTipo" onClick="fntEditTipo(' . $arrData[$i]['cod_tipo_usuario'] . ')" title="Editar"><i class="ri-edit-2-line"></i></button>
				<button type="button" class="btn btn-danger btn-sm btnDelTipo" onClick="fntDelTipo(' . $arrData[$i]['cod_tipo_usuario'] . ')" title="Eliminar"><i class="ri-delete-bin-5-line"></i></button>
				</div>';
        }


        #JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        exit();
    }

    ### GUARDAR DATA ###
    public function setTipo()
    {

        if ($_POST) {
            #Capturo los datos
            $intIdTipo = intval($_POST['idTipo']);

            $name = strClean($_POST['txtName']);
            $description = strClean($_POST['txtDescription']);
            $status = intval($_POST['listStatus']);

            #Si no viene ningun ID - Estoy creando 1 nuevo
            if ($intIdTipo == 0) {
                #Crear
                $request_Tipo = $this->model->insertTipo($name, $description, $status);
                $option = 1;
            } else {
                #Actualizar
                $request_Tipo = $this->model->updateTipo($intIdTipo, $name, $description, $status);
                $option = 2;
            }

            if ($request_Tipo > 0) {
                if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                } else {
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }
            } else if ($request_Tipo === 'existe') {
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El tipo de usuario ya existe.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'No es posible almacenar los datos');
            }

            #Convierto .json
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    ### ELIMINAR TIPO DE USUARIO ###
    public function delTipoUsuario()
    {

        if ($_POST) {

            $intIdTipo = intval($_POST['cod_tipo_usuario']);

            $requestDelete = $this->model->deleteTipo($intIdTipo);

            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el tipo de usuario');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el tipo de usuario.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            die();
        }
    }

    ### EDITAR TIPO DE USUARIO ###    
    public function getTipo(int $idrol)
    {

        $intIdTipo = intval($idrol);

        if ($intIdTipo  > 0) {
            $arrData = $this->model->editTipo($intIdTipo);
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
