<?php
class Compras extends Controllers
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
    public function Compras()
    {
        $data['page_title'] = "Jipsafety | Compras";
        $data['page_name'] = "Compras";
        $data['description'] = "";
        $data['breadcrumb-item'] = "Usuarios";
        $data['breadcrumb-activo'] = "Usuario";
        #$data['page_functions_js'] = "functions_bancos.js";

        #Cargo la vista(tipos). La vista esta en View - Tipos
        $this->views->getView($this, "compra", $data);
    }

    function obtenerProveedores()
    {

        #Modelo lostProveedores
        $arrData = $this->model->lostProveedores();

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
