<?php
### CLASE MONEDA  ###
class Moneda extends Controllers
{

    public function __construct()
    {
        session_start(); #Inicio sesion
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
        parent::__construct();
    }

    ### CONTROLADOR ###
    public function Moneda()
    {
        $data['page_title'] = "Jipsafety | Moneda";
        $data['page_name'] = "Moneda";
        $data['description'] = "";
        $data['breadcrumb-item'] = "Usuarios";
        $data['breadcrumb-activo'] = "Usuario";
        $data['page_functions_js'] = "functions_moneda.js";

        #Data modal
        $data['page_title_modal'] = "Nueva moneda";
        $data['page_title_bold'] = "Estimado usuario";
        $data['descrption_modal1'] = "Los campos remarcados con";
        $data['descrption_modal2'] = "son necesarios.";
        $data['data-sidebar-size'] = 'sm';

        #Cargo la vista(tipos). La vista esta en View - Tipos
        $this->views->getView($this, "moneda", $data);
    }

    ### CONTROLADOR: MOSTRAR TODAS LAS MONEDAS ###
    public function getMoneda()
    {
        #Cargo el modelo(selectBancos) 
        $arrData = $this->model->selectMoneda();

        for ($i = 0; $i < count($arrData); $i++) {

            #Localidad
            if ($arrData[$i]['es_local'] == 1) {
                $arrData[$i]['es_local'] = '<img id="header-lang-img" src="https://jip.grupopaniagua.com/assets/images/flags/nic.svg" alt="Header Language" height="20" class="rounded"><span> Nacional</span>';
            } else {
                $arrData[$i]['es_local'] = '<img id="header-lang-img" src="https://jip.grupopaniagua.com/assets/images/flags/int.svg" alt="Header Language" height="20" class="rounded"><span> Internacional</span>';
            }

            #Estado
            if ($arrData[$i]['activo'] == 1) {
                $arrData[$i]['activo'] = '<span class="badge rounded-pill bg-success">Activo</span>';
            } else {
                $arrData[$i]['activo'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
            }

            #Botones de accion
            $arrData[$i]['options'] = '<div class="text-center">
				<button type="button" class="btn btn-warning btn-sm btnEditBanco" onClick="fntEditMoneda(' . $arrData[$i]['cod_moneda'] . ')" title="Editar"><i class="ri-edit-2-line"></i></button>
				<button type="button" class="btn btn-danger btn-sm btnDelBanco" onClick="fntDelMoneda(' . $arrData[$i]['cod_moneda'] . ')" title="Eliminar"><i class="ri-delete-bin-5-line"></i></button>
				</div>';
        }


        #JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        exit();
    }

    ### CONTROLADOR: GUARDAR NUEVA MONEDA ###
    public function setMoneda()
    {

        if ($_POST) {

            /*dep($_POST);
            exit();*/

            #Capturo los datos
            $intIdMoneda = intval($_POST['idMoneda']);
            $nombre      = strClean($_POST['txtName']);
            $listLocal   = intval($_POST['listLocal']);
            $status      = intval($_POST['listStatus']);


            #Si no viene ningun ID - Estoy creando 1 nuevo
            if ($intIdMoneda == 0) {

                #Crear
                $request_Moneda = $this->model->insertMoneda($nombre, $listLocal, $status);

                /* dep($request_Tipo);
                  exit();*/

                $option = 1;
            } else {
                #Actualizar
                $request_Moneda = $this->model->updateMoneda($intIdMoneda, $nombre, $listLocal, $status);
                $option = 2;
            }

            #Verificar
            if ($request_Moneda > 0) {
                if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                } else {
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }
            } else if ($request_Moneda === 'existe') {
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El tipo de usuario ya existe.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'No es posible almacenar los datos');
            }

            #Convierto .json
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    ### CONTROLADOR: ELIMINAR MONEDA ###
    public function delMoneda()
    {
        if ($_POST) {

            $intIdMoneda = intval($_POST['cod_moneda']);

            $requestDelete = $this->model->deleteMoneda($intIdMoneda);

            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la moneda');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la moneda.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            die();
        }
    }

    ### CONTROLADOR: EDITAR MONEDA ###    
    public function EditMoneda(int $idMoneda)
    {
        #id
        $intIdMoneda = intval($idMoneda);

        if ($intIdMoneda > 0) {
            $arrData = $this->model->editMoneda($intIdMoneda);

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
