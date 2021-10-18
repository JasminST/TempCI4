<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Dashs extends BaseController
{
	use ResponseTrait;
	public function __construct() {
		$this->data = [
			'title' => 'SDERP - Perfil'
		];
		$this->data["js"] = [
			base_url('theme/src/assets/libs/jquery/dist/jquery.min.js'),
			base_url('theme/src/assets/libs/popper.js/dist/umd/popper.min.js'),
			base_url('theme/src/assets/libs/bootstrap/dist/js/bootstrap.min.js'),
			base_url('theme/dist/js/app.min.js'),
			base_url('theme/dist/js/app.init.horizontal.js'),
			base_url('theme/dist/js/app-style-switcher.horizontal.js'),
			base_url('theme/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js'),
			base_url('theme/src/assets/extra-libs/sparkline/sparkline.js'),
			base_url('theme/dist/js/waves.js'),
			// base_url('theme/dist/js/sidebarmenu.js'),
			base_url('theme/dist/js/custom.min.js'),
		];
		$this->data["css"] = [
			'https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
			'https://fonts.googleapis.com/css?family=Muli:400,300',
			base_url('theme/dist/css/bootstrap.min.css'),
			base_url('theme/dist/css/paper-dashboard.css'),
			base_url('theme/dist/css/themify-icons.css'),
		];
		$this->model = model("UsuariosModel");
	}
	public function index()
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');

		$d = $this->data;
		$d["udata"] = $this->model->getUser(session()->get("IdUsu"));
		array_push($d["js"],base_url('theme/src/assets/libs/echarts/dist/echarts-en.min.js'));
		// array_push($d["js"],base_url('theme/dist/js/pages/echarts/bar/bar.js'));
		array_push($d["css"],base_url('theme/dist/css/style.min.css'));

		return view('dashs/index',$d);
	}
}
