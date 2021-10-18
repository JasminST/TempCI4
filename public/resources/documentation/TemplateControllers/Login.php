<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_controller
{
	public function __construct(){
		parent::__construct();
		
		$this->layout->setLayout('temp_login');
		$this->layout->css(
				array(base_url()."public/assets/css/bootstrap.min.css",
				base_url()."public/assets/css/paper-dashboard.css",
				base_url()."public/assets/css/demo.css",
				base_url()."public/assets/css/font-awesome/css/font-awesome.min.css",
				base_url()."public/assets/css/fonts/css?family=Muli:400,300",
				base_url()."public/assets/css/themify-icons.css"		
		));
		
		$this->layout->js(
			array(base_url()."public/assets/js/jquery.min.js",
				base_url()."public/assets/js/jquery-ui.min.js",
				base_url()."public/assets/js/perfect-scrollbar.min.js",
				base_url()."public/assets/js/bootstrap.min.js",
				base_url()."public/assets/js/jquery.validate.min.js",
				base_url()."public/assets/js/es6-promise-auto.min.js",
				base_url()."public/assets/js/moment.min.js",
				base_url()."public/assets/js/bootstrap-switch-tags.js",
				base_url()."public/assets/js/paper-dashboard.js",
				base_url()."public/assets/js/demo.js"
			));
	}
	public function index(){
		//Si no existe una session se dirije automaticamente a el formulario login
		if($this->session->userdata('ususuario')){
			//con session
        	//carga el template con un titulo y redirije a la vista index
			redirect(base_url().'appperf_'.$this->session->userdata("nmsufijo"),  301);
        	
	    }
		else
		{
			//sin session
			//colocamos un titulo para el formulario
			redirect(base_url().'login/form_login',301);
		}
	}
	public function form_login(){
		if ( $this->input->post() )
        {
            	//para que exista un usuario debe tener una relacion desde departamento, usuario, permiso, rol, asignacion, menu , aplicacion
           		$rpta=$this->usuarios_model->logUsuario($this->input->post("txtusuario",true),$this->input->post("txtpassword",true));
				

           		if($rpta==1)
           		{
           			//retorna los datos del que existen en la base de datos
           			$datos1=$this->usuarios_model->getUsuario($this->input->post("txtusuario",true), $this->input->post("txtpassword",true));
           			//retorna el proyecto  activo
           			//coloca la informacion del usuario en las variables de session  cod_com,usu_log,des_car
	                $this->session->set_userdata('idusuario',$datos1[0]['iCodUsuario']);
	                $this->session->set_userdata('icusuario',$datos1[0]['iCreUsuario']);
	                $this->session->set_userdata('ususuario',$datos1[0]['cNomUsuario']);
	                //$this->session->set_userdata('apeusuario',$datos1[0]['cApePersonal']);
					$this->session->set_userdata('nmperfil',$datos1[0]['cTipUsuario']);
					$this->session->set_userdata('menus',$this->getMenu());
					redirect(base_url().'login',  301);

           		}else
           		{
           			 $this->session->set_flashdata('ControllerMessage', '<b>ERROR!!</b>, durante el logueo:<br>-El usuario o la contraseña no coinciden!!!<br>-Es posible que el usuario este inactivo.');
	            	//si el usuario no existe es enviado a el formulario de nuevo
           		
					redirect(base_url().'login/form_login',  301);
				}        
			}
        //si no existe el evento post solo muestra el formulario para que ingrese sus datos
        $this->layout->setTitle("Software de Gestion de Formatos de Calidad - Login   ");
		$this->layout->view("frmlogin");
	}
	public function cerrar_sesion(){
		//destruye la session y redirije al usuario a la pagina inicial del login
		$this->session->sess_destroy();
		redirect(base_url().'login',  301);
	}

	public function pagi_about(){
				$this->layout->setTitle("Software de Gestion de Calidad - Acerca de");
				$this->layout->view('pagabout');

	}
	
	public function getMenu(){
		$contador=0;
		$homero= array();
		$query=$this->db->query("SELECT * FROM modulo ".
		"where cNomModulo like '".$this->session->userdata("nmperfil")."';");
		//echo $this->db->last_query();
		foreach ($query->result() as $row)
		{
			$this->session->set_userdata('nmsufijo',$row->cAbrModulo);
		
		 	
		}

	 	$contador++;
		$this->getMenuPrinc($row->iCodModulo, $contador, $homero);
	 	$contador--;
		
		
		return $homero;
	}
	public function getMenuPrinc($padre, $contador=0, &$menu=array()){
		
		$query=$this->db->query("SELECT * FROM modulo ".
		"where iPadModulo like '".$padre."';");
		//echo $this->db->last_query();
		foreach ($query->result() as $row)
		{
		 	$rpta= array();
			$rpta['nivel']=$contador;
		 	$rpta['icono']=$row->cIcoModulo;
		 	$rpta['codigo']=$row->iCodModulo;
		 	$rpta['abrev']=$row->cAbrModulo;
		 	$rpta['nombre']=$row->cNomModulo;
		 	$rpta['url']=$row->cUrlModulo;
		 	$rpta['padre']=$row->iPadModulo;
		 	array_push($menu,$rpta);
		 	$contador++;
		 	$this->getMenuPrinc($row->iCodModulo, $contador, $menu);
		 	$contador--;
		}


	}

}
?>