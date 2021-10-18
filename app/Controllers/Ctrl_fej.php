<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
//Por adaptar al ejemplo general
class Ctrl_fej extends BaseController
{
	use ResponseTrait;
	public function __construct() {
		$this->data = [
			'title' => 'SD - Formato Ejemplo',
			'ctrl' => 'ctrl_fej',
			'rol' => null,
		];
		$this->data["js"] = [
			base_url('theme/src/assets/libs/jquery/dist/jquery.min.js'),
			base_url('theme/src/assets/libs/popper.js/dist/umd/popper.min.js'),
			base_url('theme/src/assets/libs/bootstrap/dist/js/bootstrap.min.js'),
			base_url('theme/dist/js/app.min.js'),
			base_url('theme/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js'),
			base_url('theme/src/assets/extra-libs/sparkline/sparkline.js'),
			base_url('theme/src/assets/libs/datatables/media/js/jquery.dataTables.min.js'),
			base_url('theme/dist/js/app.init.horizontal.js'),
			base_url('theme/dist/js/app-style-switcher.horizontal.js'),
			base_url('theme/dist/js/waves.js'),
			base_url('theme/dist/js/sidebarmenu.js'),
			base_url('theme/dist/js/custom.min.js'),
			base_url('theme/dist/js/pages/datatable/custom-datatable.js'),
			base_url('theme/dist/js/pages/datatable/datatable-api.init.js'),
			base_url('theme/src/assets/extra-libs/toastr/toastr-init.js'),
			base_url('theme/src/assets/extra-libs/toastr/dist/build/toastr.min.js'),
			base_url('theme/src/assets/libs/sweetalert2/dist/sweetalert2.all.min.js'),
			base_url('theme/src/assets/extra-libs/sweetalert2/sweet-alert.init.js'),
		];
		$this->data["css"] = [
			'https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
			'https://fonts.googleapis.com/css?family=Muli:400,300',
			base_url('theme/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'),
			base_url('theme/src/assets/extra-libs/toastr/dist/build/toastr.min.css'),
			base_url('theme/dist/css/style.css'),
		];
		$this->model = model("LiqsModel");
		if(session()->get("IdTUsu")) $this->data["rol"] = session()->get()["IdTUsu"];
		helper('form');
	}
	public function index()
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');

		$d = $this->data;
		$d["cols"] = json_encode([
			["data"=> 'FcreLiq', "title"=> "Fecha", "className"=> "text-center"], //Fecha
			["data"=> 'NroLiq', "title"=> "Nº Liq", "className"=> "text-center"], //Nro
			["data"=> 'TotLiq', "title"=> "Total", "className"=> "text-center"], //Total
			["data"=> 'SalLiq', "title"=> "Saldo", "className"=> "text-center"], //Saldo
			["data"=> 'EstLiq', "title"=> "Estado", "className"=> "text-center"], //Estado (pastillas)
			["data"=> null, "defaultContent" => "", "title" => "ACCIONES"], //Acciones
		]);
		$d["colsr"] = json_encode([ //Columnas liqs trabajadores
			["data"=> 'FcreLiq', "title"=> "Fecha", "className"=> "text-center"], //Fecha
			["data"=> 'LogUsu', "title"=> "Usuario", "className"=> "text-center", "visible"=> true], //Nro
			["data"=> 'NroLiq', "title"=> "Nº Liq", "className"=> "text-center"], //Nro
			["data"=> 'TotLiq', "title"=> "Total", "className"=> "text-center"], //Total
			["data"=> 'SalLiq', "title"=> "Saldo", "className"=> "text-center"], //Saldo
			["data"=> 'EstLiq', "title"=> "Estado", "className"=> "text-center"], //Estado (pastillas)
			["data"=> null, "defaultContent" => "", "title" => "ACCIONES"], //Acciones
		]);
		//JS
			array_push($d["js"],base_url('theme/dist/js/custom.min.js'));
			array_push($d["js"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js');
			array_push($d["js"], base_url("resources/assets/js/lists.js")); //js para todas las listas
			
			array_push($d["css"],base_url('theme/dist/css/style.min.css'));
			array_push($d["css"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css');
		
		return view('liqs/lista',$d);
	}
	public function nueva()
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');
		$d = $this->data;
		$d["id"] = null;
		$d["dtreg"] = null;
		$b = false; //Desactivado?
		$d = array_merge($d,$this->preProc());
		$d = array_merge($d,$this->getInp(["plu"=>$d["lu"],"id"=>null,"plgp"=>$d["plgp"],"b"=>$b]));
		$d["b2"] = $b;
		// JS
			array_push($d["js"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js');
			array_push($d["js"],base_url('theme/src/assets/libs/select2/dist/js/select2.full.min.js'));
			array_push($d["js"],base_url('theme/src/assets/libs/select2/dist/js/select2.min.js'));
			array_push($d["js"],base_url('theme/dist/js/pages/forms/select2/select2.init.js'));
			array_push($d["js"], base_url('theme/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')); //js para todos los forms
			array_push($d["js"], base_url('theme/src/assets/libs/jquery-validation/dist/additional-methods.js')); //js para todos los forms 
			array_push($d["js"], base_url('theme/src/assets/libs/moment/moment.js'));
			array_push($d["js"], base_url('resources/assets/js/bootstrap-datetimepicker.js'));
			array_push($d["js"], base_url("resources/assets/js/forms.js")); //js para todos los forms
			array_push($d["js"], base_url("theme/src/assets/libs/dropzone/dist/min/dropzone.min.js")); //js para todos los forms
		//CSS
			array_push($d["css"],base_url('theme/src/assets/libs/select2/dist/css/select2.min.css'));
			array_push($d["css"],base_url('theme/src/assets/libs/dropzone/dist/min/dropzone.min.css'));
			array_push($d["css"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css');

		return view('liqs/editar',$d);
	}
	public function editar($id)
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');
		$d = $this->data;
		$d["dtreg"] = $this->model->select("*,date(FupdLiq) as FupdLiq, date(FcreLiq) as FcreLiq")->find($id);
		$d["id"] = $id;

		$b = false; //Desactivado?
		$d["b2"] = $b;
		$d = array_merge($d,$this->preProc());
		$d = array_merge($d,$this->getInp(["plu"=>$d["lu"],"id"=>null,"plgp"=>$d["plgp"],"b"=>$b]));
		// JS
			array_push($d["js"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js');
			array_push($d["js"],base_url('theme/src/assets/libs/select2/dist/js/select2.full.min.js'));
			array_push($d["js"],base_url('theme/src/assets/libs/select2/dist/js/select2.min.js'));
			array_push($d["js"],base_url('theme/dist/js/pages/forms/select2/select2.init.js'));
			array_push($d["js"], base_url('theme/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')); //js para todos los forms
			array_push($d["js"], base_url('theme/src/assets/libs/jquery-validation/dist/additional-methods.js')); //js para todos los forms 
			array_push($d["js"], base_url('theme/src/assets/libs/moment/moment.js'));
			array_push($d["js"], base_url('resources/assets/js/bootstrap-datetimepicker.js'));
			array_push($d["js"], base_url("resources/assets/js/forms.js")); //js para todos los forms
			array_push($d["js"], base_url("theme/src/assets/libs/dropzone/dist/min/dropzone.min.js")); //js para todos los forms
		//CSS
			array_push($d["css"],base_url('theme/src/assets/libs/select2/dist/css/select2.min.css'));
			array_push($d["css"],base_url('theme/src/assets/libs/dropzone/dist/min/dropzone.min.css'));
			array_push($d["css"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css');

		return view('liqs/editar',$d);
	}
	public function ver($id)
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');
		$d = $this->data;
		$d["dtreg"] = $this->model->select("*,date(FupdLiq) as FupdLiq, date(FcreLiq) as FcreLiq")->find($id);
		$d["id"] = $id;

		$b = true; //Desactivado?
		$d["b2"] = $b;
		$d = array_merge($d,$this->preProc());
		$d = array_merge($d,$this->getInp(["plu"=>$d["lu"],"id"=>null,"plgp"=>$d["plgp"],"b"=>$b]));
		// JS
			array_push($d["js"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js');
			array_push($d["js"],base_url('theme/src/assets/libs/select2/dist/js/select2.full.min.js'));
			array_push($d["js"],base_url('theme/src/assets/libs/select2/dist/js/select2.min.js'));
			array_push($d["js"],base_url('theme/dist/js/pages/forms/select2/select2.init.js'));
			array_push($d["js"], base_url('theme/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')); //js para todos los forms
			array_push($d["js"], base_url('theme/src/assets/libs/jquery-validation/dist/additional-methods.js')); //js para todos los forms 
			array_push($d["js"], base_url('theme/src/assets/libs/moment/moment.js'));
			array_push($d["js"], base_url('resources/assets/js/bootstrap-datetimepicker.js'));
			array_push($d["js"], base_url("resources/assets/js/forms.js")); //js para todos los forms
			array_push($d["js"], base_url("theme/src/assets/libs/dropzone/dist/min/dropzone.min.js")); //js para todos los forms
		//CSS
			array_push($d["css"],base_url('theme/src/assets/libs/select2/dist/css/select2.min.css'));
			array_push($d["css"],base_url('theme/src/assets/libs/dropzone/dist/min/dropzone.min.css'));
			array_push($d["css"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css');

		return view('liqs/editar',$d);
	}
	public function preProc()
	{
		$d = [];
		$mu = model("UsuariosModel");
		
		$lu = $mu->where(["IdTUsu" => 4])->findAll(); //Obtener lista de Jefes y revisores
		$plu = [""=>"Seleccionar"];

		foreach ($lu as $us) $plu[$us["IdUsu"]] = $us["NomUsu"]; //Procesar
		$d["lu"] = $plu;
		
		$lgp = $this->model->db->table("gpresup")->select("IdGpres, concat(CcGpres,' - ',NomGpres) as NomGpres")->get()->getResultArray(); //Lista de grupo de presupuesto
		$plgp = [""=>"Seleccionar"];
		foreach ($lgp as $gp) $plgp[$gp["IdGpres"]] = $gp["NomGpres"]; //Procesar
		$d["plgp"] = $plgp;
		return $d;
	}
	public function getInp($a)
	{
		/*
			plu: Revisor
			id: id liq
			plgp: opciones grupo presupuesto
			b: editar?
		*/
		$d = [];
		$d["inp1"] = [//Lista de Inputs
			[// ID
				"class" => '',
				"wdth" => 0, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'hidden', 'name' => 'IdLiq', 'id' => 'IdLiq'], //Opciones, si es un select, sino Otros atributos
			],
			[//Legend Encabezado
				"class" => 'col-md-12', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'legend', //select, input, legend, check, button, text
				"label" => 'Encabezado',
			],
			[// 2 Modificacion
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 2, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Modificación',
				"data" => ['type' => 'date','name' => 'FupdLiq', 'id' => 'FupdLiq', 'class' => 'form-control', "disabled" => "true", 'value' => date("Y-m-d"),], //Opciones, si es un select, sino Otros atributos
			],
			[// 2 Creación
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 2, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Creación',
				"data" => ['type' => 'date','name' => 'FcreLiq', 'id' => 'FcreLiq', 'class' => 'form-control', 'disabled' => "true", 'value' => date("Y-m-d"),], //Opciones, si es un select, sino Otros atributos
			],
			[//Legend Datos
				"class" => 'col-md-12', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'legend', //select, input, legend, check, button, text
				"label" => 'Datos',
			],
			[// 4 Nro Liq
				"class" => 'col-md-4 mb-4', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Nombre Liquidación (Nº)',
				"disabled" => $a["b"],
				'valid-feed' => "Correcto",
				'invalid-feed' => "Campo Obligatorio",
				"data" => ['type' => 'text','name' => 'NroLiq', 'id' => 'NroLiq', 'class' => 'form-control', 'required' => 'true', ], //Opciones, si es un select, sino Otros atributos
			],
			[// 4 Centro Costos
				"class" => 'col-md-4 mb-4', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Centro de Costos',
				"disabled" => $a["b"],
				"data" => ['type' => 'text','name' => 'CcosLiq', 'id' => 'CcosLiq', 'class' => 'form-control', ], //Opciones, si es un select, sino Otros atributos
			],
			[// 4 OC
				"class" => 'col-md-4 mb-4', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'OC (Nº)',
				"disabled" => $a["b"],
				"data" => ['type' => 'text','name' => 'OcLiq', 'id' => 'OcLiq', 'class' => 'form-control', ], //Opciones, si es un select, sino Otros atributos
			],
			[// 4 Tipo
				"class" => 'col-md-4 mb-4', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'select', //select, input, legend, check, button, text
				"label" => 'Tipo Liq',
				"disabled" => $a["b"],
				"data" => ['name' => 'TipoLiq', 'class' => 'select2 form-control custom-select', "style" => "width: 100%;",], //Opciones, si es un select, sino Otros atributos
				"options" => ["1" => "Normal","2" => "Especial",], //Opciones, si es un select, sino Otros atributos
			],
			[// 4 Estado
				"class" => 'col-md-4 mb-4', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'select', //select, input, legend, check, button, text
				"label" => 'Estado',
				"disabled" => $a["b"],
				"data" => ['name' => 'EstLiq', 'class' => 'select2 form-control custom-select', "style" => "width: 100%;",], //Opciones, si es un select, sino Otros atributos
				"options" => ["0" => "Pendiente","1" => "Pagada",], //Opciones, si es un select, sino Otros atributos
			],
			[// 4 Revisor
				"class" => 'col-md-4 mb-4', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'select', //select, input, legend, check, button, text
				"label" => 'Revisor',
				"disabled" => $a["b"],
				"data" => ['name' => 'IdRevisor', 'class' => 'select2 form-control custom-select', "style" => "width: 100%;",], //Opciones, si es un select, sino Otros atributos
				"options" => $a['plu'], //Opciones, si es un select, sino Otros atributos
			],
		];
		$d["inp2"] = [//Lista de Inputs Tabla Items
			[//Legend Items
				"class" => 'col-md-12', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'legend', //select, input, legend, check, button, text
				"label" => 'Lista Items',
			],
			[// Button Nuevo Item
				"class" => "col-md-12",
				"wdth" => 12, //select, input, legend, check, button, text
				"type" => "button",
				"label" => "Nuevo Item",
				"disabled" => $a["b"],
				"icon" => "fas fa-plus",
				"data" => ["class"=>"btn btn-primary", 'id' => "btitems", 'style' => "color: white;",], //"data-toggle"=>"modal", "data-target"=>"#mitems",
			],
			[// Tabla de Items
				"class" => "col-md-12 text-center",
				"wdth" => 12, //select, input, legend, check, button, text
				"type" => "text",
				"text" => '<table id="titems" class="table table-striped table-bordered display" style="width:100%"></table>'
			],
			[// Total texto
				"class" => "col-md-6 text-center",
				"wdth" => 6, //select, input, legend, check, button, text
				"type" => "text",
				"text" => "<p class='pull-right'>Total:</p>"
			],
			[// Total Soles Input
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 2, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'number','name' => 'TotLiq', 'id' => 'TotLiq', 'class' => 'form-control', 'disabled' => "true",], //Opciones, si es un select, sino Otros atributos
			],
			[// Total Soles Input
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'number','name' => 'TotdLiq', 'id' => 'TotdLiq', 'class' => 'form-control', 'disabled' => "true",], //Opciones, si es un select, sino Otros atributos
			],
			[// Dinero Entregado texto
				"class" => "col-md-6 text-center",
				"wdth" => 6, //select, input, legend, check, button, text
				"type" => "text",
				"text" => "<p class='pull-right'>Dinero Entregado:</p>"
			],
			[// Dinero Entregado Soles Input
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 2, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'number','name' => 'EntrLiq', 'id' => 'EntrLiq', 'class' => 'form-control', 'disabled' => "true",], //Opciones, si es un select, sino Otros atributos
			],
			[// Dinero Entregado Soles Input
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'number','name' => 'EntrdLiq', 'id' => 'EntrdLiq', 'class' => 'form-control', 'disabled' => "true",], //Opciones, si es un select, sino Otros atributos
			],
			[// Saldo texto
				"class" => "col-md-6 text-center",
				"wdth" => 6, //select, input, legend, check, button, text
				"type" => "text",
				"text" => "<p class='pull-right'>Saldo:</p>"
			],
			[// Saldo Soles Input
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 2, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'number','name' => 'SalLiq', 'id' => 'SalLiq', 'class' => 'form-control', 'disabled' => "true",], //Opciones, si es un select, sino Otros atributos
			],
			[// Saldo Soles Input
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'number','name' => 'SaldLiq', 'id' => 'SaldLiq', 'class' => 'form-control', 'disabled' => "true",], //Opciones, si es un select, sino Otros atributos
			],
		];
		$d["inp3"] = [//Lista de Inputs Tabla Pago
			[//Legend Pago
				"class" => 'col-md-12', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'legend', //select, input, legend, check, button, text
				"label" => 'Lista Pagos',
			],
			[// Button Nuevo Pago
				"class" => "col-md-12",
				"wdth" => 12, //select, input, legend, check, button, text
				"type" => "button",
				"label" => "Nuevo Pago",
				"disabled" => $a["b"],
				"icon" => "fas fa-plus",
				"data" => ["class"=>"btn btn-primary", "data-toggle"=>"modal", "data-target"=>"#mpagos", 'style' => "color: white;",],
			],
			[//Tabla de Pagos
				"class" => "col-md-12 text-center",
				"wdth" => 12, //select, input, legend, check, button, text
				"type" => "text",
				"text" => '<table id="tpagos" class="table table-striped table-bordered display" style="width:100%"></table>'
			],
			[// Total texto
				"class" => "col-md-6 text-center",
				"wdth" => 6, //select, input, legend, check, button, text
				"type" => "text",
				"text" => "<p class='pull-right'>Total:</p>"
			],
			[// Saldo Soles Input
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 2, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'number','name' => 'EntrLiq', 'id' => 'EntrLiq', 'class' => 'form-control', 'disabled' => "true",], //Opciones, si es un select, sino Otros atributos
			],
			[// Saldo Soles Input
				"class" => 'col-md-2 mb-3', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'number','name' => 'EntrdLiq', 'id' => 'EntrdLiq', 'class' => 'form-control', 'disabled' => "true",], //Opciones, si es un select, sino Otros atributos
			],
		];
		$d["inpit"] = [//Lista de Inputs Item
			[// ID
				"class" => '',
				"wdth" => 0, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'hidden', 'name' => 'IdItem', 'id' => 'IdItem'], //Opciones, si es un select, sino Otros atributos
			],
			[// ID liq
				"class" => '',
				"wdth" => 0, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'hidden', 'name' => 'IdLiq',"value"=>$a['id']], //Opciones, si es un select, sino Otros atributos
			],
			[// Fecha
				"class" => 'col-md-12 mb-3', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'date','name' => 'FechItem', 'id' => 'FechItem', 'class' => 'form-control', 'value' => date("Y-m-d"),], //Opciones, si es un select, sino Otros atributos
			],
			[//Legend Datos
				"class" => 'col-md-12', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'legend', //select, input, legend, check, button, text
				"label" => 'Datos',
			],
			[// Lugar
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'text','name' => 'LugarItem', 'id' => 'LugarItem', "placeholder" => "Lugar", 'class' => 'form-control',], //Opciones, si es un select, sino Otros atributos
			],
			[// Num Doc
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'text','name' => 'NdocItem', 'id' => 'NdocItem', "placeholder" => "Num Doc", 'class' => 'form-control',"required" => "true"], //Opciones, si es un select, sino Otros atributos
			],
			[// Establecimiento
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'text','name' => 'EstabItem', 'id' => 'EstabItem', "placeholder" => "Establecimiento", 'class' => 'form-control',], //Opciones, si es un select, sino Otros atributos
			],
			[// Descripcion
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'text','name' => 'DescItem', 'id' => 'DescItem', "placeholder" => "Descripción", 'class' => 'form-control',], //Opciones, si es un select, sino Otros atributos
			],
			[// Grupo Presupuesto
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 3, //Peso, si llega a 12 nuevo row
				"type" => 'select', //select, input, legend, check, button, text
				"label" => 'Grupo',
				"disabled" => $a["b"],
				"data" => ["name"=>"IdGpres","id"=>"IdGpres", 'class' => 'form-control', "style" => "width: 100%;", "required" => "true"], //Opciones, si es un select, sino Otros atributos
				"options" => $a["plgp"], //Opciones, si es un select, sino Otros atributos
			],
			[// Presupuesto
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 3, //Peso, si llega a 12 nuevo row
				"type" => 'select', //select, input, legend, check, button, text
				"label" => 'Presupuesto',
				"disabled" => $a["b"],
				"data" => ['name' => 'IdPres',"id"=>"IdPres", 'class' => 'form-control', "style" => "width: 100%;", "required" => "true"], //Opciones, si es un select, sino Otros atributos
				"options" => ["" => "Seleccionar",], //Opciones, si es un select, sino Otros atributos
			],
			[// Observación
				"class" => 'col-md-12 mb-3', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'textarea', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'text', 'name' => 'ObsItem', 'id' => 'ObsItem', "placeholder" => "Observación", 'rows' => '3', 'class' => 'form-control',], //Opciones, si es un select, sino Otros atributos
			],
			[//Legend Costo
				"class" => 'col-md-12', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'legend', //select, input, legend, check, button, text
				"label" => 'Costos',
			],
			[// Soles
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"preigtext" => 'S/.',
				"data" => ['type' => 'number','name' => 'CostItem', 'id' => 'CostItem', "min" => "0", "max" => "1000", 'class' => 'form-control',], //Opciones, si es un select, sino Otros atributos
			],
			[// Dolares
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"preigtext" => '$',
				"data" => ['type' => 'number','name' => 'CostdItem', 'id' => 'CostdItem', "min" => "0", "max" => "1000", 'class' => 'form-control',], //Opciones, si es un select, sino Otros atributos
			],
		];
		$d["inppg"] = [//Lista de Inputs Pagos
			[// ID
				"class" => '',
				"wdth" => 0, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'hidden', 'name' => 'IdPago', 'id' => 'IdPago'], //Opciones, si es un select, sino Otros atributos
			],
			[// ID liq
				"class" => '',
				"wdth" => 0, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"data" => ['type' => 'hidden', 'name' => 'IdLiq',"value"=>$a['id']], //Opciones, si es un select, sino Otros atributos
			],
			[// Fecha
				"class" => 'col-md-12 mb-3', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'date','name' => 'FechPago', 'id' => 'FechPago', 'class' => 'form-control', 'value' => date("Y-m-d"),], //Opciones, si es un select, sino Otros atributos
			],
			[//Legend Datos
				"class" => 'col-md-12', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'legend', //select, input, legend, check, button, text
				"label" => 'Datos',
			],
			[// Num Oper
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'text','name' => 'NoperPago', 'id' => 'NoperPago', "maxlenght" => "45", "placeholder" => "Num Operación", 'class' => 'form-control','required' => true,], //Opciones, si es un select, sino Otros atributos
			],
			[// Descripcion
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'text','name' => 'DescPago', 'id' => 'DescPago', "placeholder" => "Descripción", 'class' => 'form-control',], //Opciones, si es un select, sino Otros atributos
			],
			[//Legend Importe
				"class" => 'col-md-12', //Clase del div que lo contiene
				"wdth" => 12, //Peso, si llega a 12 nuevo row
				"type" => 'legend', //select, input, legend, check, button, text
				"label" => 'Importe',
			],
			[// Soles
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'number','name' => 'ImpPago', 'id' => 'ImpPago', "min" => "0", "max" => "1000", "placeholder" => "S/.", 'class' => 'form-control',], //Opciones, si es un select, sino Otros atributos
			],
			[// Dolares
				"class" => 'col-md-6 mb-3', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"disabled" => $a["b"],
				"data" => ['type' => 'number','name' => 'ImpdPago', 'id' => 'ImpdPago', "min" => "0", "max" => "1000", "placeholder" => "$", 'class' => 'form-control',], //Opciones, si es un select, sino Otros atributos
			],
		];
		return $d;
	}

	// AJAX
	public function ajaxlliq() //Ajax lista liquidaciones
	{
		$idu = session()->get("IdUsu");
		$dt = $this->model->join("usuarios u","u.IdUsu = liqs.IdTrab")->where("IdTrab",$idu)->findAll();
		return $this->setResponseFormat('json')->respond(["data" => $dt]);
	}
	public function ajaxlliqr() //Ajax lista liquidaciones revisor
	{
		$dt = $this->model
			->select("IdLiq,FcreLiq,u.LogUsu,NroLiq,TotLiq,SalLiq,EstLiq")
			->join("usuarios u","u.IdUsu = liqs.IdTrab")
			->findAll();
		return $this->setResponseFormat('json')->respond(["data" => $dt]);
	}
	public function ajaxeditar() //Editar Liquidacion
	{
		$p = $this->request->getVar();
		try {
			$b = false;
			// print_r($p);
			// echo $p["IdLiq"]." ".(isset($p["IdLiq"])?"Iset":"Not Iset")." ".(isEmpty($p["IdLiq"]) ? "Is Empty" : "Not empty");
			if(isset($p["IdRevisor"]) && $p["IdRevisor"] == "") $p["IdRevisor"] = null;
			if(isset($p["IdLiq"]) && $p["IdLiq"] == "") $p["IdLiq"] = null;
			$p["FupdLiq"] = date("Y-m-d H:i");
			if(!isset($p["IdLiq"])) {
				unset($p["IdLiq"]);
				$p["IdTrab"] = session()->get("IdUsu");
				$p["FcreLiq"] = date("Y-m-d H:i");
				$b = $this->model->insert($p);
			}
			else{
				$id = $p["IdLiq"];
				unset($p["IdLiq"]);
				$b = $this->model->update($id,$p);
			}
			if($b) return $this->setResponseFormat('json')->respond(["m" => "Operación Correcta", "r"=>true, "q" => $this->model->db->getLastQuery()->getQuery()]);
			else return $this->setResponseFormat('json')->respond(["m" => "Datos erróneos", "r"=>true]);
		} catch (\Throwable $th) {
			return $this->setResponseFormat('json')->respond(["m" => "Puede que no haya conexión o que haya un error en el servidor", "r"=>false, "q" => $this->model->db->getLastQuery()->getQuery()]); //.$th->getMessage()." ".$this->model->getLastQuery()->getQuery()
		}
		return redirect()->to('/liqs');
	}
	public function ajaxeli() //Eliminar una liquidacion
	{
		$id = $this->request->getVar("id");
		try {
			$b = $this->model->delete($id);
			if($b) return $this->setResponseFormat('json')->respond(["m" => "Liquidación eliminada", "r"=>true]);
			else return $this->setResponseFormat('json')->respond(["m" => "Error al guardar, si la liquidación tiene pagos o items no se puede eliminar", "r"=>false]);
			// session()->setFlashdata(['msg' => 'Operación correcta','r' => true]);
			// session()->setFlashdata(['msg' => 'Error al guardar, si la liquidación tiene pagos o items no se puede eliminar','r' => false]);
		} catch (\Throwable $th) {
			return $this->setResponseFormat('json')->respond(["m" => 'Error al eliminar, la liquidación tiene pagos o items', "msg" => $th->getMessage(),'r' => false]);
		}
	}

	// OTROS
	public function validar()
	{
		echo "<br><h2> Session </h2><br>";
		print_r(session()->get());
	}
	public function upload() //Subir imagen del item con id
	{
		var_dump($this->request->getFiles());
		$id = $this->request->getVar("id");
		$newName = '';
		if($imagefile = $this->request->getFiles()){
			foreach($imagefile as $img){
				if ($img->isValid() && ! $img->hasMoved()){
					$newName = $img->getRandomName();
					$this->model->db->table("itemfiles")
						->insert(
							[
								"IdItem"=>$id,
								"FcreItemf"=>date("Y-m-d H:i"),
								"UrlItemf"=>'uploads/items/'.$newName,
								"NameItemf" => $img->getName()
							]);
					$img->move(ROOTPATH.'public/uploads/items/', $newName);
				}
			}
		}
		$status = 1;
		return 'uploads/items/'.$newName;
	}
	public function delfile()
	{
		$id = $this->request->getVar("id");
		$fn = $this->request->getVar("name");
		// var_dump($id,$fn);
		try {
			$b = $this->model->db->table("itemfiles")->where(["IdItemf" => $id])->delete();
			if($b) {
				$s = unlink(str_replace("\\","/",ROOTPATH)."public/".$fn); # Arreglar url
				return $this->setResponseFormat('json')->respond(["m" => 'Archivo eliminado R:'.$s,'r' => true,'lq' => $this->model->db->getLastQuery()->getQuery()]);
			} 
			else return $this->setResponseFormat('json')->respond(["m" => 'Error al eliminar el archivo, puede que ya esté eliminado','r' => false]);
		} catch (\Throwable $th) {
			return $this->setResponseFormat('json')->respond(["m" => 'Puede que no haya conexión o que haya un error en el servidor E:'.$th->getMessage()." L>".$th->getLine(),'r' => false]);
		}

	}
}
