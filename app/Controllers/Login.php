<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\IncomingRequest;

class Login extends BaseController
{
	public function __construct() {
		$this->data = [
			"title" => "BGC - Login",
			"h1" => "Login",
			"ctrl" => "login",
			"page" => "index",
		];
		helper('form');
		$this->model = model('LoginModel');
	}
	public function index()
	{
		$d = $this->data;
		return view('Login/form', $d);
	}
	public function ajaxlogin()
	{
		$s = session();
		// $p = $this->request->getPost();
		$l = $this->request->getVar('logus');
		$p = $this->request->getVar('pasus');

		$q = $this->model->login($l,$p);
		if(isset($q)){
			// print_r($q);
			$s->set($q);
			return redirect()->to('/usuarios');
		}else{
			$s->setFlashdata(['msg' => 'El usuario está inactivo o las contraseña no coinciden.','r' => false]);
			// print_r($this->model->getLastQuery()->getQuery());
			return redirect()->to('/login');
		}
	}
	public function logout()
	{
		$s = session();
		$s -> destroy();
		return redirect()->to('/login');
	}
	public function validar()
	{
		echo "<br><h1>Login</h1><br>";
		$q = $this->model->login("TRAB1","Asdf1234")->getRowArray();
		$r = $this->model->db->affectedRows();
		print_r($q);
		print_r($r);
		$s = session();
		$s -> set($q);
		$s->setFlashdata('message', '<b>ERROR</b>, Usuario y Contraseña no coinciden o el Usuario está inactivo');
		echo "<br><h1>Session</h1><br>";
		print_r(($s->getFlashdata()?"true":"false"));
	}
}
