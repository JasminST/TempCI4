<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Ctrl_fejModel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\PrintForm;
//Por adaptar al ejemplo general
class Ctrl_fej extends BaseController
{
	use ResponseTrait;
	public function __construct() {
		$this->data = [
			'title' => 'SD - Ejemplo',
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
		$this->model = model("Ctrl_fejModel");
		if(session()->get("IdTUsu")) $this->data["rol"] = session()->get()["IdTUsu"];
		helper('form');
	}
	public function index()
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');

		$d = $this->data;
		$d["cols"] = json_encode([
			["data"=> 'IdFej', "title"=> "Id", "className"=> "text-center"], //Id
			["data"=> 'FcreFej', "title"=> "Fecha Creacion", "className"=> "text-center"], //Fecha
			["data"=> 'FmodiFej', "title"=> "Fecha Modificacion", "className"=> "text-center"], //Fecha
			//["data"=> 'IdUsu', "title"=> "Usuario", "className"=> "text-center"], //Usuario
			["data"=> 'NomUsu', "title"=> "Usuario", "className"=> "text-center"], //Usuario
			["data"=> null, "defaultContent" => "", "title" => "ACCIONES"], //Acciones
		]);
		$d["colsr"] = json_encode([ //Columnas ctrl_fej trabajadores
			["data"=> 'IdFej', "title"=> "Id", "className"=> "text-center"], //Id
			["data"=> 'FcreFej', "title"=> "Fecha Creacion", "className"=> "text-center"], //Fecha
			["data"=> 'FmodiFej', "title"=> "Fecha Modificacion", "className"=> "text-center"], //Fecha
			//["data"=> 'IdUsu', "title"=> "Usuario", "className"=> "text-center"], //Usuario
			["data"=> 'NomUsu', "title"=> "Usuario", "className"=> "text-center"], //Usuario
			["data"=> null, "defaultContent" => "", "title" => "ACCIONES"], //Acciones
		]);
		//JS
			array_push($d["js"],base_url('theme/dist/js/custom.min.js'));
			array_push($d["js"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js');
			array_push($d["js"], base_url("resources/assets/js/lists.js")); //js para todas las listas
			
			array_push($d["css"],base_url('theme/dist/css/style.min.css'));
			array_push($d["css"],'https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css');
		
		return view('ctrl_fej/lista',$d);
	}
	public function nueva()
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');
		$d = $this->data;
		$d["id"] = null;
		$d["dtreg"] = null;

		$b = false; //Desactivado?
		$d["b2"] = $b;

		//$d = array_merge($d,$this->preProc());
		$d = array_merge($d,$this->getInp([]));
		
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

		return view('ctrl_fej/editar',$d);
	}
	public function editar($id)
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');
		
		$d = $this->data;
		$d["dtreg"] = $this->model->find($id);
		$d["id"] = $id;

		$b = false; //Desactivado?
		$d["b2"] = $b;
		//$d = array_merge($d,$this->preProc());
		$d = array_merge($d,$this->getInp([])); //le mando un arreglo vacio 
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
		
		$fej = new Ctrl_fejModel(); //referencia a modelo
		$d["fej"]=$fej->where('IdFej', $id)->first();
		return view('ctrl_fej/editar',$d);
	}
	public function ver($id)
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');
		$d = $this->data;
		//$d["dtreg"] = $this->model->select("*,date(FupdLiq) as FupdLiq, date(FcreLiq) as FcreLiq")->find($id);
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

		return view('ctrl_fej/editar',$d);
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
				"data" => ['type' => 'hidden', 'name' => 'IdFej', 'id' => 'IdFej'], //Opciones, si es un select, sino Otros atributos
			],
			[// 4 Fecha creacion
				"class" => 'col-md-4 mb-3', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Fecha de creación',
				"data" => ['type' => 'date','name' => 'FcreFej', 'id' => 'FcreFej', 'class' => 'form-control FcreFej', "disabled" => "true", 'value' => date("Y-m-d"),], //Opciones, si es un select, sino Otros atributos
			],
			[// 4 Fecha modificacion
				"class" => 'col-md-4 mb-3', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Fecha de modificación',
				"data" => ['type' => 'date','name' => 'FmodiFej', 'id' => 'FmodiFej', 'class' => 'form-control FmodiFej' ], //Opciones, si es un select, sino Otros atributos
			],
			[// 4 ID Usu
				"class" => 'col-md-4 mb-3', //Clase del div que lo contiene
				"wdth" => 4, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Id usuario',
				"data" => ['type' => 'text', 'name' => 'IdUsu', 'id' => 'IdUsu', 'class' => 'form-control' ] //Opciones, si es un select, sino Otros atributos
			],
		];

		$d["inp2"] = [//crear de Inputs
				
			[// 2 Fecha creacion
				"class" => 'col-md-6 mb-4', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Fecha de creación Nuevo',
				"data" => ['type' => 'date','name' => 'FcreFej', 'id' => 'FcreFej', 'class' => 'form-control FcreFej'], //Opciones, si es un select, sino Otros atributos
			],
			[// 3 Fecha modificacion
				"class" => 'col-md-6 mb-4', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Fecha de modificación Nuevo',
				"data" => ['type' => 'date','name' => 'FmodiFej', 'id' => 'FmodiFej', 'class' => 'form-control FmodiFej'], //Opciones, si es un select, sino Otros atributos
			],
			[// ID Usu
				"class" => 'col-md-6 mb-4', //Clase del div que lo contiene
				"wdth" => 6, //Peso, si llega a 12 nuevo row
				"type" => 'input', //select, input, legend, check, button, text
				"label" => 'Id usuario Nuevo',
				"data" => ['type' => 'text', 'name' => 'IdUsu', 'id' => 'IdUsu', 'class' => 'form-control IdUsu' ] //Opciones, si es un select, sino Otros atributos
			],
		];
		
		return $d;
	}

	

	
	// AJAX

	public function ajaxguardar() 
	{
		//$ctrlfej = new Ctrl_fej;}
		$t = false;
		$dt = $this->request->getVar();
		PrintForm::println("dt",$dt,$t);
		try {
			$ctrlM = new Ctrl_fejModel(); //referencia a modelo
			$d = [
				'FcreFej' =>$this->request->getVar('FcreFej'),
				'FmodiFej'=>$this->request->getVar('FmodiFej'),
				'IdUsu' =>$this->request->getVar('IdUsu')
			];
			$ctrlM->insert($d);
			PrintForm::printlq($this->model,$t);
		} catch (\Throwable $th) {
			return $this->setResponseFormat('json')->respond(["r" => false, "msg" => "Error"]);
			//throw $th;
		}
		return $this->setResponseFormat('json')->respond(["r" => true, "msg" => "Exito"]);
		
	}

	public function ajaxupdate(){ //actualizar los datos en Ctrl_fej

		//$ctrlfej = new Ctrl_fej;
		$t = false;
		$dt = $this->request->getVar();
		PrintForm::println("dt",$dt,$t);
		try {
			$ctrlM = new Ctrl_fejModel(); //referencia a modelo
			$id= $this->request->getVar('IdFej');
			$d = [
				'FcreFej' =>$this->request->getVar('FcreFej'),
				'FmodiFej'=>$this->request->getVar('FmodiFej'),
				'IdUsu' =>$this->request->getVar('IdUsu')
			];
			$ctrlM->update($id, $d);
			PrintForm::printlq($this->model,$t);
		} catch (\Throwable $th) {
			return $this->setResponseFormat('json')->respond(["r" => false, "msg" => "Error"]);
			//throw $th;
		}
		return $this->setResponseFormat('json')->respond(["r" => true, "msg" => "Exito"]);

	}



	public function ajaxlliq() //Ajax lista liquidaciones
	{
		$idu = session()->get("IdUsu");
		$dt = $this->model->join("usuarios u","u.IdUsu = ctrl_fej.IdUsu")->where("ctrl_fej.IdUsu",$idu)->findAll();
		return $this->setResponseFormat('json')->respond(["data" => $dt]);
	}

	public function ajaxlliqr() //Ajax lista liquidaciones revisor
	{
		$dt = $this->model
			->select("IdLiq,FcreLiq,u.LogUsu,NroLiq,TotLiq,SalLiq,EstLiq")
			->join("usuarios u","u.IdUsu = ctrl_fej.IdUsu")
			->findAll();
		return $this->setResponseFormat('json')->respond(["data" => $dt]);
	}
	

	


	public function ajaxedit() //Editar Liquidacion
	{
		$ctrlM = new Ctrl_fejModel(); //referencia a modelo
		$d['fej']=$ctrlM->where('IdFej', $id)->first();
		$p = $this->request->getVar();
		try {
			$b = false;
			// print_r($p);
			// echo $p["IdLiq"]." ".(isset($p["IdLiq"])?"Iset":"Not Iset")." ".(isEmpty($p["IdLiq"]) ? "Is Empty" : "Not empty");
			//if(isset($p["IdRevisor"]) && $p["IdRevisor"] == "") $p["IdRevisor"] = null;
			if(isset($p["IdFej"]) && $p["IdFej"] == "") $p["IdFej"] = null;
			//$p["FupdLiq"] = date("Y-m-d H:i");
			if(!isset($p["IdFej"])) {
				unset($p["IdFej"]);
				$p["IdUsu"] = session()->get("IdUsu");
				$p["FcreFej"] = session()->get("FcreFej");
				$p["FmodiFej"] = session()->get("FmodiFej");
				$b = $this->model->insert($p);
			}
			else{
				$id = $p["IdFej"];
				unset($p["IdFej"]);
				$b = $this->model->update($id,$p);
			}
			if($b) return $this->setResponseFormat('json')->respond(["m" => "Operación Correcta", "r"=>true, "q" => $this->model->db->getLastQuery()->getQuery()]);
			else return $this->setResponseFormat('json')->respond(["m" => "Datos erróneos", "r"=>true]);
		} catch (\Throwable $th) {
			return $this->setResponseFormat('json')->respond(["m" => "Puede que no haya conexión o que haya un error en el servidor", "r"=>false, "q" => $this->model->db->getLastQuery()->getQuery()]); //.$th->getMessage()." ".$this->model->getLastQuery()->getQuery()
		}
		return redirect()->to('/ctrl_fej');
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
