<?php

class LoginModel extends Mysql
	{
        
	private $intIdUsuario;
        private $email;
        private $password;
        //private $token;

		public function __construct()
		{
			parent::__construct();
		}

    ### LOGIN ###
    public function loginUser(string $email, string $password){
        #Data
    	$this->email     = $email;
    	$this->password  = $password;

        $sql = "SELECT cod_usuario, activo
                FROM secure_user                
                WHERE correo = '$this->email' AND contrasenia = '$this->password' and activo!= 0";
    	
    	 $request = $this->select($sql);
    	 return $request;       
    }


    public function sessionLogin(int $iduser){
            $this->intIdUsuario = $iduser;
            
            $sql = "SELECT  u.idusuario,
                            u.nombre,
                            u.apellido,
                            u.telefono,
                            u.email,
                            u.estado,
                            u.rolid

                    FROM usuario u
                    INNER JOIN rol r #Tabla secundaria
                    ON u.rolid = r.idrol
                    WHERE u.idusuario = $this->intIdUsuario";
    
            $request = $this->select($sql);
            $_SESSION['userData'] = $request;
            return $request;
        }
}