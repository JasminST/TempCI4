<?php

use Greenter\Model\Sale\Haccpba06;

defined('BASEPATH') or exit('No direct script access allowed');

class Haccp06 extends CI_controller
{
	public function __construct()
	{
		parent::__construct();

		$this->data = array(
			'idmenu' => 11,
			'idsubmenu' => 30,
			'notifs' => $this->usuarios_model->getNotifs($this->session->userdata("idusuario"))->result_array(),
			'ctrl' => 'haccp06',
			'dash' => 'haccp06temp',
			'titl' => 'SGC - HACCP06'
		);
		$this->model = $this->haccp06_model;
		$this->camps = $this->model->camps;
		$this->ccamps = $this->model->ccamps; //Asociativo
		$this->codi = $this->model->codi;
		$this->dmod = "dModiSalm";
		$this->dcre = "dCreaSalm";
		$this->data["nnotifs"] = count($this->data["notifs"]);
		$this->layout->setTitle($this->data["titl"]);

		$this->css = array(
			base_url() . "public/assets/css/bootstrap.min.css",
			base_url() . "public/assets/css/paper-dashboard.css",
			base_url() . "public/assets/css/demo.css",
			base_url() . "public/assets/css/font-awesome/css/font-awesome.min.css",
			base_url() . "public/assets/css/fonts/css?family=Muli:400,300",
			base_url() . "public/assets/css/themify-icons.css",
			base_url() . "public/assets/css/jquery.dataTables.min.css",
			base_url() . "public/assets/css/select.dataTables.min.css"
		);
		$this->js = array(
			base_url() . "public/assets/js/jquery.min.js",
			base_url() . "public/assets/js/jquery-ui.min.js",
			base_url() . "public/assets/js/perfect-scrollbar.min.js",
			base_url() . "public/assets/js/bootstrap.min.js",
			base_url() . "public/assets/js/jquery.validate.min.js",
			base_url() . "public/assets/js/es6-promise-auto.min.js",
			base_url() . "public/assets/js/moment.min.js",
			base_url() . "public/assets/js/bootstrap-datetimepicker.js",
			base_url() . "public/assets/js/bootstrap-selectpicker.js",
			base_url() . "public/assets/js/bootstrap-switch-tags.js",
			base_url() . "public/assets/js/jquery.easypiechart.min.js",
			base_url() . "public/assets/js/chartist.min.js",
			base_url() . "public/assets/js/bootstrap-notify.js",
			base_url() . "public/assets/js/sweetalert2.js",
			base_url() . "public/assets/js/jquery-jvectormap.js",
			base_url() . "public/assets/js/jquery.bootstrap.wizard.min.js",
			base_url() . "public/assets/js/bootstrap-table.js",
			base_url() . "public/assets/js/jquery.datatables.js",
			base_url() . "public/assets/js/dataTables.select.min.js",
			base_url() . "public/assets/js/fullcalendar.min.js",
			base_url() . "public/assets/js/paper-dashboard.js",
			base_url() . "public/assets/js/table-to-json/lib/jquery.tabletojson.min.js",
			base_url() . "public/assets/js/demo.js"
		);
		$this->layout->setLayout('temp_appnot_pla');
		$this->layout->css($this->css);
		$this->layout->js($this->js);
		
	}
	public function index()
	{
		if (!$this->session->userdata('ususuario'))
			redirect(base_url() . 'login/form_login', 301);
		//Si no existe una session se dirije automaticamente a el formulario login
		$idu = $this->session->userdata("idusuario");
		$dia = $this->input->post("fechaconsulta", true);
		$dlist = null;
		if ($dia)
			$dlist = $this->model->getDList($idu, $dia);
		// print_r($this->db->last_query());
		$list = $this->model->getList($idu);
		
		// print_r($list->result_array());
		$d = $this->data;
		$d["list"] = $list;
		$d["dlist"] = $dlist;
		$d["dia"] = $dia;
		$d["titl"] = "SGC - Listado";
		$c = [0,2,3,4,5,6,7,8,9,10,11,12,13];
		$lc = []; //Cargar lista de parametros
		foreach ($c as $v) array_push($lc, $this->camps[$v]);
		$d["lcamp"] = $lc;
		
		$js = $this->js;
		array_push($js,base_url() . "public/assets/js/" . $this->data["ctrl"] . "/list_reg.js");
		$this->layout->js($js);

		$this->layout->setTitle($d["titl"]);
		$this->layout->view('list_reg', $d);
	}
	public function editar($idr)
	{
		if (!$this->session->userdata('ususuario'))
			redirect(base_url() . 'login/form_login', 301);
		
		$d = $this->data;
		$js = $this->js;
		array_push($js,base_url() . "public/assets/js/" . $this->data["ctrl"] . "/edit_reg.js");
		$this->layout->js($js);
		$reg = $this->model->getReg($idr)->row();
		$prop = "fecha";
		$date = new DateTime($reg->$prop);
		$reg->hour = $date->format("H:i");
		$d["reg"] = $reg;
		// print_r($reg);
		$this->layout->setTitle('SGC - HACCP06 Editar');
		$this->layout->view('edit_reg', $d);
	}
	public function nuevo()
	{
		if (!$this->session->userdata('ususuario'))
			redirect(base_url() . 'login/form_login', 301);
		$d = $this->data;
		$d["titl"] = "HACCP06 - Nuevo Registro ";

		$js = $this->js;
		array_push($js,base_url() . "public/assets/js/" . $this->data["ctrl"] . "/nuev_reg.js");
		$this->layout->js($js);

		$this->layout->setTitle($d["titl"]);
		$this->layout->view('nuev_reg',$d);
	}
	public function ajaxnvoregistro()
	{
		if (!$this->session->userdata('ususuario'))
			redirect(base_url() . 'login/form_login', 301);
		try {
			$d = $this->ccamps;
			$sub = array();
			foreach ($_POST as $k => $v)//Mapeo
				$sub[$d[$k]] = $v;
			$sub[$this->dcre] = date('Y-m-d H:i:s');
			$sub[$this->dmod] = date('Y-m-d H:i:s');
			$sub['iCodUsuario'] = $this->session->userdata("idusuario");

			// print_r($sub);
			$q = $this->model->createRegistro($sub);
			// $q = true;
			if ($q)
				echo json_encode(array('r' => true, 'des' => 'Registro insertado correctamente'));
			else
				echo json_encode(array('r' => false, 'des' => 'Error en la base de datos'));
		} catch (Throwable $th) {
			echo json_encode(array('r' => false, 'des' => "Error en el código del servidor: $th"));
		}
	}
	public function ajaxeliregistro($id)
	{
		if (!$this->session->userdata('ususuario'))
			redirect(base_url() . 'login/form_login', 301);
		try {
			$q = $this->model->deleteRegistro($id);
			// $q = true;
			if ($q)
				echo json_encode(array('r' => true, 'des' => 'Registro eliminado'));
			else
				echo json_encode(array('r' => false, 'des' => 'Error en la base de datos'));
		} catch (Throwable $th) {
			echo json_encode(array('r' => false, 'des' => 'Error en el código del servidor'));
		}
	}
	public function ajaxeditregistro($id)
	{
		if (!$this->session->userdata('ususuario'))
			redirect(base_url() . 'login/form_login', 301);
		try {
			$d = $this->ccamps;
			$sub = array();
			foreach ($_POST as $k => $v)//Mapeo
				$sub[$d[$k]] = $v;
			$sub[$this->dmod] = date('Y-m-d H:i:s');
			// print_r($_POST);
			$q = $this->model->chRegistro($id, $sub);
			if ($q)
				echo json_encode(array('r' => true, 'des' => 'Registro editado'));
			else
				echo json_encode(array('r' => false, 'des' => 'Error en la base de datos'));
		} catch (Throwable $th) {
			echo json_encode(array('r' => false, 'des' => 'Error en el código del servidor'));
		}
	}

	public function pdf($dia)
	{
		if (!$this->session->userdata('ususuario'))
			redirect(base_url() . 'login/form_login', 301);

		require __DIR__ . '/../../vendor/autoload.php';
		$util = Util::getInstance();

		$p = false; //Está en testing?
		$idu = $this->session->userdata("idusuario");

		//Todos los datos
		$data = array();
		$data['fecha'] = $dia;

		$date = new DateTime($dia);
		$data['semana'] = $date->format("W");
		$data['detalle'] = $this->model->getRegPdf($idu, $dia)->result_array();

		$data['nusu'] = $this->model->getNusu($idu, $dia)->nusu;

		// Calcular observaciones y acciones
		$do = $this->model->getObs($idu, $dia)->result_array();
		$obs = array();
		$aco = array();
		foreach ($do as $v) {
			array_push($obs,$v['cObsSalm']);
			array_push($aco,$v['cAcoSalm']);
		}
		$data['obs'] = $obs;
		$data['aco'] = $aco;
		//Calcular turno
		$turno = "Fuera de tiempo";
		$t = strtotime(date('H:i:s', strtotime($this->model->getLfec($idu, $dia)->last)));
		if ($t <= strtotime('15:00:00') && $t >= strtotime('05:00:00')) // Dia [5am - 3pm]
			$turno = "Día";
		else if ($t <= strtotime('04:00:00') || $t >= strtotime('18:00:00')) // Noche [6pm - 4am]
			$turno = "Noche";
		$data['turno'] = $turno;
		$data['maxl'] = 16;
		//echo $this->db->last_query();
		//echo print_r($infDetalle->result());
		$invoice = new Haccpba06($dia, $data);
		if ($p) {
			echo "<br><br><br> Detalle> ";
			print_r($data['detalle']);
			echo "<br><br><br> Turno> ";
			print_r($data['turno']);
			echo "<br><br><br> Observaciones> ";
			print_r($aco);
			print_r($obs);
			echo "<br><br><br> Nombre> ";
			print_r($data['nusu']);
		}

		try {
			$pdf = $util->getPdf($invoice);
			if ($p)
				echo "<br><br>Name> " . $invoice->getName() . '.pdf';
			else
				$util->showPdf($pdf, $invoice->getName() . '.pdf');
		} catch (Exception $e) {
			var_dump($e);
		}
	}

	// DASHBOARD
	/*
	Documentación:
		Se utiliza una función por cada Gráfico con la notación:
			[codreg][ngraf]
		En esta vista tenemos los siguientes gráficos:
			HACCP08: (CONTROL DE TEMPERATURA DE SALMUERA)
				tlper - TReal Porcentaje de Injección(líneas - Promedio Porcentaje)
				tltsa - TReal Temperatura salm (líneas - Promedio T < 4)
				dltsa - Diario Temperatura salm(lineas - Promedio T < 4)
				sltsa - Semanal Temperatura salm(lineas - Promedio T < 4)
	*/

	public function haccp06temp()
	{
		if (!$this->session->userdata('ususuario'))
			redirect(base_url() . 'login/form_login', 301);

		$this->layout->setLayout('temp_appnot_ofi');
		//carga el template con un titulo y redirije a la vista index
		$d = $this->data;
		$d["idmenu"] = 1;
		$d["idsubmenu"] = 32;
		$d["notifs"] = $this->usuarios_model->getNotifs($this->session->userdata("idusuario"))->result_array();
		$d["nnotifs"] = count($d["notifs"]);
		$d["titl"] = "Temperatura Salmuera";

		$js = $this->js;
		array_push($js,base_url() . "public/assets/js/" . $this->data["ctrl"] . "/".$this->data["dash"].".js");
		array_push($js,base_url() . "public/assets/js/chartjs.min.js");
		array_push($js,base_url() . "public/assets/js/updnot.js");
		$this->layout->js($js);

		$this->layout->setTitle($d["titl"]);
		$this->layout->view($this->data["dash"], $d);
	}

	//AJAX 
	// tlper - TReal Porcentaje de Injección
	public function ajaxHaccp06tlper()
	{
		$p = false; //En Testing

		$date = date('Y-m-d');
		$q = $this->db->select("min(hora) as hora, tp, round(avg(p),2) as p")
			->from($this->data["dash"])
			->group_by('tp, FLOOR((UNIX_TIMESTAMP(fa) / 5))')
			->where('date(fa)',$date)
			->order_by('hora','desc')
			->get('', 24);
		$s = $this->db->last_query();
		$q = $this->db->select("*")
			->from("($s) t")
			->order_by('hora')
			->get();
		$res = $q->result_array();
		if ($p) {
			echo "<br><br><br> Fecha> " . $date;
			print_r($this->db->last_query());
			echo "<br><br><br> Res>";
			print_r($res);
		}else
			echo json_encode(array('r' => true, 'd' => json_encode($res)));
	}
	// tltsa - TReal Temperatura salm
	public function ajaxHaccp06tltsa()
	{
		$p = false; //En Testing

		$date = date('Y-m-d');
		$q = $this->db->select("min(hora) as hora, round(avg(t),2) as t")
			->from($this->data["dash"])
			->group_by('FLOOR((UNIX_TIMESTAMP(fa) / 5))')
			->where('date(fa)',$date)
			->order_by('hora','desc')
			->get('', 24);
		$s = $this->db->last_query();
		$q = $this->db->select("*")
			->from("($s) t")
			->order_by('hora')
			->get();
		$res = $q->result_array();
		if ($p) {
			echo "<br><br><br> Fecha> " . $date;
			print_r($this->db->last_query());
			echo "<br><br><br> Res>";
			print_r($res);
		}else
			echo json_encode(array('r' => true, 'd' => json_encode($res)));
	}
	// dltsa - Diario
	public function ajaxHaccp06dltsa()
	{
		$p = false; //En Testing

		$date = date('Y-m-d');
		$q = $this->db->select("min(fecha) as fecha, round(avg(t),2) as t")
			->from($this->data["dash"])
			->group_by('date(fa)')
			->where('fa between (DATE_SUB("' . $date . '", INTERVAL 7 DAY)) and "' . $date . ' 23:59:59"')
			->order_by('fecha')
			->get('', 24);
		$res = $q->result_array();
		if ($p) {
			echo "<br><br><br> Fecha> " . $date;
			print_r($this->db->last_query());
			echo "<br><br><br> Res>";
			print_r($res);
		}else
			echo json_encode(array('r' => true, 'd' => json_encode($res)));
	}
	// sltsa - Semanal
	public function ajaxHaccp06sltsa()
	{
		$p = false; //En Testing

		$date = date('Y-m-d');
		$q = $this->db->select("min(semana) as semana, min(fa) as fa, round(avg(t),2) as t")
			->from($this->data["dash"])
			->group_by('semana')
			->where('fa between (DATE_SUB("' . $date . '", INTERVAL 3 MONTH)) and "' . $date . ' 23:59:59"')
			->order_by('fa')
			->get('', 24);
		$res = $q->result_array();
		if ($p) {
			echo "<br><br><br> Fecha> " . $date;
			print_r($this->db->last_query());
			echo "<br><br><br> Res>";
			print_r($res);
		}else
			echo json_encode(array('r' => true, 'd' => json_encode($res)));
	}

	// Validaciones
	private function validar()
	{
		$idu = $this->session->userdata("idusuario");
		// Model
		// echo "<br><br><br><h3>Modelo</h3>";
		// echo "<br><h4>Camp</h4><br>";
		// print_r($this->model->camps);
		// echo "<br><h4>String</h4><br>";
		// print_r($this->model->dcamps);
		// echo "<br><h4>Associative</h4><br>";
		// print_r($this->model->ccamps);
		// echo "<br><h4>PDF</h4><br>";
		// print_r($this->model->pdfdcamps);
		// echo "<br><h4>Reg</h4><br>";
		// print_r($this->model->rcamps);
		// echo "<br><h4>List</h4><br>";
		// print_r($this->model->getReg(1)->row());
		// echo "<br><br><h3>Query</h3><br>";
		// print_r($this->db->last_query());
		// echo "<br><h4>DList</h4><br>";
		// print_r($this->model->getDList($idu, date("Y-m-d"))->result_array());
		// echo "<br><br><h3>Query</h3><br>";
		// print_r($this->db->last_query());

		// echo "<br><br><br><h3>Data</h3>";
		// echo "<br><h3>TLPER</h3><br>";
		// print_r($this->ajaxHaccp06tlper());
		// echo "<br><h3>TLTSA</h3><br>";
		// print_r($this->ajaxHaccp06tltsa());
		// echo "<br><h3>DLTSA</h3><br>";
		// print_r($this->ajaxHaccp06dltsa());
		// echo "<br><h3>SLTSA</h3><br>";
		// print_r($this->ajaxHaccp06sltsa());
	}
}
