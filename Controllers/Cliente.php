<?php
### CLASE CLIENTES  ###
class Cliente extends Controllers
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
    public function Cliente()
    {
        $data['page_title'] = "Dashboard | Clientes";
        $data['page_name'] = "Clientes";
        $data['description'] = "";
        $data['breadcrumb-item'] = "Usuarios";
        $data['breadcrumb-activo'] = "Usuario";
        $data['data-sidebar-size'] = "sm";
        $data['page_functions_js'] = "functions_clientes.js";

        #Data modal
        $data['page_title_modal'] = "Nuevo cliente";
        $data['page_title_bold'] = "Estimado usuario";
        $data['descrption_modal1'] = "Los campos remarcados con";
        $data['descrption_modal2'] = "son necesarios.";


        #Cargo la vista(tipos). La vista esta en View - Tipos
        $this->views->getView($this, "clientes", $data);
    }

    ### CONTROLADOR: MOSTRAR TODOS LOS CLIENTES ###
    public function getClientes()
    {

        $arrData = $this->model->selectClientes();

        for ($i = 0; $i < count($arrData); $i++) {

            #Localidad
             if ($arrData[$i]['exento_impuesto'] == 1) {
                $arrData[$i]['exento_impuesto'] = 'Si';
            } else {
                $arrData[$i]['exento_impuesto'] = 'No';
            }

            #Estado
            if ($arrData[$i]['activo'] == 1) {
                $arrData[$i]['activo'] = '<span class="badge rounded-pill bg-success">Activo</span>';
            } else {
                $arrData[$i]['activo'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
            }

            #Botones de accion
            $arrData[$i]['options'] = '<div class="text-center">
				<button type="button" class="btn btn-warning btn-sm " onClick="fntEditCliente(' . $arrData[$i]['cod_cliente'] . ')" title="Editar"><i class="ri-edit-2-line"></i></button>
				<button type="button" class="btn btn-danger btn-sm" onClick="fntDelCliente(' . $arrData[$i]['cod_cliente'] . ')" title="Eliminar"><i class="ri-delete-bin-5-line"></i></button>
				</div>';
        }

        #JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        exit();
    }

    ### CONTROLADOR: GUARDAR NUEVO CLIENTE### 
    /*public function setCliente()
    {

        //$data = json_decode(file_get_contents('php://input'), true);

        /*var_dump($data);
        exit();*




        /*foreach ($data as $rows) {
            $ComboxContact = $rows['ComboxContact'];
            $Descripcion = $rows['Descripcion'];
            $Extension = $rows['Extension'];



            //$apellido = $rows['lastName'];
        }*





        #Capturo los datos
        // $intIdContacto = intval($_POST['idContacto']);

        //$descripcion = strClean($_POST['descripcion']);
        /*$telefono    = strClean($_POST['telefono']);
            $correo      = strClean($_POST['correo']);
            $web         = strClean($_POST['web']);
            $status      = intval($_POST['listStatus']);*

        #Si no viene ningun ID - Estoy creando 1 nuevo
        //if ($intIdContacto == 0) {

        #Crear
        $request_Contacto = $this->model->insertCliente($ComboxContact, $Descripcion, $Extension);


        var_dump($request_Contacto);
        exit();

        $option = 1;
        // } else {
        #Actualizar
        //$request_Contacto = $this->model->updateContacto($intIdContacto, $descripcion, $telefono, $correo, $web, $status);
        //$option = 2;
        //}

        #Verificar
        if ($request_Contacto > 0) {
            if ($option == 1) {
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
            }
        } else if ($request_Contacto === 'existe') {
            $arrResponse = array('status' => false, 'msg' => '¡Atención! El tipo de usuario ya existe.');
        } else {
            $arrResponse = array('status' => true, 'msg' => 'No es posible almacenar los datos');
        }

        #Convierto .json
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

        die();
    }*/

    public function setCliente()
    {

        if ($_POST) {

            /*dep($_POST);
            exit();*/

            #Capturo los datos
            $intIdCliente = intval($_POST['idClientes']);

            $nombre          = strClean($_POST['nombre']);
            $ruc             = strClean($_POST['ruc']);
            $comboxPais      = intval($_POST['comboxPais']);
            $personaContacto = strClean($_POST['personaContacto']);
            $comboxPago      = intval($_POST['comboxPago']);
            $statusImpuesto  = intval($_POST['statusImpuesto']);
            $lStatus         = intval($_POST['lStatus']);

            #Si no viene ningun ID - Estoy creando 1 nuevo
            if ($intIdCliente == 0) {

                #Crear
                $request_Cliente = $this->model->insertCliente($nombre, $ruc, $comboxPais, $personaContacto, $comboxPago, $statusImpuesto, $lStatus);

                /* dep($request_Tipo);
                  exit();*/

                $option = 1;
            } else {
                #Actualizar
                $request_Banco = $this->model->updateBanco($intIdBanco, $name, $nota, $listLocal, $status);
                $option = 2;
            }

            #Verificar
            if ($request_Cliente > 0) {
                if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                } else {
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }
            } else if ($request_Cliente === 'existe') {
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El cliente ya existe.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'No es posible almacenar los datos');
            }

            #Convierto .json
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    ### CONTROLADOR: ELIMINAR BANCO ###
    public function delBanco()
    {

        if ($_POST) {

            $intIdBanco = intval($_POST['cod_bancos']);

            $requestDelete = $this->model->deleteBanco($intIdBanco);

            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el nombre del banco');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el nombre del banco.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            die();
        }
    }

    ### CONTROLADOR: EDITAR BANCOS ###    
    public function getBanco(int $idBanco)
    {

        #id
        $intIdBanco = intval($idBanco);

        if ($intIdBanco  > 0) {
            $arrData = $this->model->editBanco($intIdBanco);
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
