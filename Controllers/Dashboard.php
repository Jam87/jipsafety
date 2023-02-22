<?php 

	class Dashboard extends Controllers{
		public function __construct()
		{
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');	
			}
			parent::__construct();
			
		}

		public function dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "";
			$data['page_title'] = "Dashboard - jipsafety";
			$data['page_name'] = "Dashboard";

			#Cargo la vista(dashboard). A traves del metodo(getView)
			$this->views->getView($this,"dashboard",$data);
		}

	}
 ?>