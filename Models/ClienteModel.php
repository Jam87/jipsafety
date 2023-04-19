<?php
### CLASE: ClientesModel ###
class ClienteModel extends Mysql
{
    private $cod_cliente;
    private $nombre_cliente;
    private $numero_ruc;
    private $cod_pais;
    private $persona_contacto;
    private $exento_impuesto;
    private $cod_forma_pago;
    private $date_registro;
    private $activo;

    public function __construct()
    {
        parent::__construct();
    }

    ### MODELO: MOSTRAR TODOS LOS CLIENTES ###
    public function selectClientes()
    {
        #Sentencia
        $sql = "SELECT c.cod_cliente , c.nombre_cliente, c.numero_ruc, c.persona_contacto, p.descripcion, c.exento_impuesto, c.activo 
                FROM bill_clientes c
                INNER JOIN cat_forma_pago p
                ON c.cod_forma_pago = p.cod_forma_pago 
                WHERE c.activo != 0";

        #Mando a llamar la función(select_all)
        $request = $this->select_all($sql);
        return $request;
    }

    ### MODELO: GUARDAR UN NUEVO CLIENTE ###
    public function insertCliente(string $nombre, string $ruc, int $comboxPais, string $personaContacto, int $comboxPago, int $statusImpuesto, int $lStatus)
    {
        $return = "";
     
        $this->nombre_cliente   = $nombre;
        $this->numero_ruc       = $ruc;
        $this->cod_pais         = $comboxPais;
        $this->persona_contacto = $personaContacto;
        $this->cod_forma_pago   = $comboxPago;
        $this->exento_impuesto  = $statusImpuesto;
        //$this->date_registro;
        $this->activo           = $lStatus;


        #Sentencia
        //$sql = "SELECT * FROM cat_contacto WHERE es_correo = '{$this->es_correo}' ";

        #Mando a llamar la función(select_all)
        //$request = $this->select_all($sql);        

        /*var_dump($request);
          exit();*/

        /*if (empty($request)) {*/

        $sql = "INSERT INTO bill_clientes(nombre_cliente, numero_ruc, cod_pais, persona_contacto, cod_forma_pago, exento_impuesto, 	activo) 
                VALUE (?,?,?,?,?,?,?)";

        #arrData: array de información
        $arrData = array($this->nombre_cliente, $this->numero_ruc, $this->cod_pais, $this->persona_contacto, $this->cod_forma_pago, $this->exento_impuesto, $this->activo);

        #Envio a la funcion insert(sentencia y data)
        $requestInsert = $this->insert($sql, $arrData);

        return $requestInsert;
        /* } else {
            $return = "existe";
        }*/
        return $return;
    }


    ### MODELO: ELIMINAR BANCO ###
    public function deleteBanco(int $intIdBanco)
    {

        #id
        $this->cod_bancos = $intIdBanco;

        $sql = "UPDATE cat_bancos SET activo = ? WHERE cod_bancos =  '{$this->cod_bancos}'";

        $arrData = array(0);
        $request = $this->update($sql, $arrData);

        if ($request) {
            $request = 'ok';
        } else {
            $request = 'error';
        }
        return $request;
    }


    ### MODELO: EDITAR BANCO ###
    public function editBanco(int $idBanco)
    {

        //Buscar Tipo de Usuario
        $this->cod_bancos = $idBanco;
        $sql = "SELECT * FROM cat_bancos WHERE cod_bancos = '{$this->cod_bancos}'";
        $request = $this->select($sql);
        return $request;
    }


    ### MODELO: ACTUALIZAR BANCO ###
    public function updateBanco(int $intIdBanco, string $name, string $nota, $listLocal, int $status)
    {

        $this->cod_bancos   = $intIdBanco;
        $this->nombre_banco = $name;
        $this->nota_banco   = $nota;
        $this->es_local     = $listLocal;
        $this->date_registro = date("F j, Y, g:i a");
        $this->activo       = $status;


        $sql = "SELECT * FROM cat_bancos WHERE nombre_banco = '$this->nombre_banco' AND cod_bancos != $this->cod_bancos";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE cat_bancos SET nombre_banco = ?, nota_banco = ?, es_local = ?, date_registro = ?, activo = ? WHERE cod_bancos  = $this->cod_bancos";
            $arrData = array($this->nombre_banco, $this->nota_banco, $this->es_local, $this->date_registro, $this->activo);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }
}
