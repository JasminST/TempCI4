<?php

namespace App\Controllers;

require_once('..\app\Libraries\signature-to-image.php');
use App\Controllers\BaseController;
use App\Libraries\PrintForm;
use CodeIgniter\API\ResponseTrait;
use Picqer\Barcode\BarcodeGeneratorPNG;

class Usuarios extends BaseController
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
		$this->model = model("UsuariosModel");
		helper('form');
		helper('twig_helper');
		$this->twig = twig_instance();
	}
	public function index()
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');

		$d = $this->data;
		$d["udata"] = $this->model->getUser(session()->get("IdUsu"));
		array_push($d["js"],base_url('theme/src/assets/extra-libs/toastr/dist/build/toastr.min.js'));
		array_push($d["js"],base_url('theme/dist/js/custom.min.js'));
		array_push($d["js"],base_url('resources/assets/js/sigpad/jquery.signaturepad.js'));
        array_push($d["js"],base_url('resources/assets/js/sigpad/json2.min.js'));
        array_push($d["css"],base_url('resources/assets/js/sigpad/jquery.signaturepad.css'));
		// base_url('theme/src/assets/extra-libs/toastr/toastr-init.js'),

		array_push($d["css"],base_url('theme/src/assets/extra-libs/toastr/dist/build/toastr.min.css'));
		array_push($d["css"],base_url('theme/dist/css/style.min.css'));

		return view('usuarios/perfil',$d);
	}
	public function pdf()
	{
		$t = false; //Testing?
		$dompdf = new \Dompdf\Dompdf();
		$dompdf->getOptions()->setChroot(ROOTPATH . 'public');
		$d = [];
		$d["reg"] = [];
		// (object) $this->model->db
		// 	->table($this->model->tab)
		// 	->select($this->model->did." as id, date(FechPm01) as fecha, time(FechPm01) as hora, date(FechfPm01) as fechaf, time(FechfPm01) as horaf, u.LogUsu, ".$this->model->psdn)
		// 	->join($this->model->tab2." s1", "s1.".$this->model->did2." = ".$this->model->tab.".IdS1")
		// 	->join($this->model->tab2." s2", "s2.".$this->model->did2." = ".$this->model->tab.".IdS2")
		// 	->join("usuarios u", "u.IdUsu = ".$this->model->tab.".IdTrab")
		// 	->where([$this->model->did => $id])->get()->getResultArray()[0];

		$ly = [
			"resources/imgsignat/barcode.png",
		];
		$d["js"] = [];
		$d["css"] = [];
		PrintForm::println("DATA: ",["doc" => $d], $t);
		if(!$t){
			$dompdf->loadHtml($this->twig->render('usuarios/pm01.html',["doc" => $d, "ly" => $ly]));
			$dompdf->setPaper('A2', 'portrait');
			// $dompdf->setPaper('A3', 'landscape');
			$dompdf->render();
			file_put_contents('resources/twigpdf/Brochure.pdf', $dompdf->output());
			$dompdf->stream("Brochure.pdf", array("Attachment" => false));
		}else{
			echo $this->twig->render('usuarios/pm01.html',["doc" => $d, "ly" => $ly]);
		}
	}
	public function saveSign()
	{
		// $json = $this->request->getVar("output");
		$json = "[{\"lx\":92,\"ly\":131,\"mx\":92,\"my\":130},{\"lx\":92,\"ly\":129,\"mx\":92,\"my\":131},{\"lx\":92,\"ly\":128,\"mx\":92,\"my\":129},{\"lx\":93,\"ly\":128,\"mx\":92,\"my\":128},{\"lx\":95,\"ly\":127,\"mx\":93,\"my\":128},{\"lx\":98,\"ly\":126,\"mx\":95,\"my\":127},{\"lx\":100,\"ly\":124,\"mx\":98,\"my\":126},{\"lx\":103,\"ly\":123,\"mx\":100,\"my\":124},{\"lx\":108,\"ly\":119,\"mx\":103,\"my\":123},{\"lx\":114,\"ly\":114,\"mx\":108,\"my\":119},{\"lx\":121,\"ly\":104,\"mx\":114,\"my\":114},{\"lx\":127,\"ly\":97,\"mx\":121,\"my\":104},{\"lx\":133,\"ly\":88,\"mx\":127,\"my\":97},{\"lx\":139,\"ly\":81,\"mx\":133,\"my\":88},{\"lx\":144,\"ly\":75,\"mx\":139,\"my\":81},{\"lx\":147,\"ly\":69,\"mx\":144,\"my\":75},{\"lx\":149,\"ly\":63,\"mx\":147,\"my\":69},{\"lx\":151,\"ly\":62,\"mx\":149,\"my\":63},{\"lx\":152,\"ly\":58,\"mx\":151,\"my\":62},{\"lx\":152,\"ly\":56,\"mx\":152,\"my\":58},{\"lx\":152,\"ly\":54,\"mx\":152,\"my\":56},{\"lx\":152,\"ly\":52,\"mx\":152,\"my\":54},{\"lx\":152,\"ly\":51,\"mx\":152,\"my\":52},{\"lx\":152,\"ly\":50,\"mx\":152,\"my\":51},{\"lx\":152,\"ly\":49,\"mx\":152,\"my\":50},{\"lx\":151,\"ly\":49,\"mx\":152,\"my\":49},{\"lx\":151,\"ly\":52,\"mx\":151,\"my\":49},{\"lx\":152,\"ly\":58,\"mx\":151,\"my\":52},{\"lx\":152,\"ly\":67,\"mx\":152,\"my\":58},{\"lx\":152,\"ly\":75,\"mx\":152,\"my\":67},{\"lx\":152,\"ly\":85,\"mx\":152,\"my\":75},{\"lx\":152,\"ly\":93,\"mx\":152,\"my\":85},{\"lx\":152,\"ly\":99,\"mx\":152,\"my\":93},{\"lx\":150,\"ly\":104,\"mx\":152,\"my\":99},{\"lx\":149,\"ly\":106,\"mx\":150,\"my\":104},{\"lx\":147,\"ly\":108,\"mx\":149,\"my\":106},{\"lx\":146,\"ly\":108,\"mx\":147,\"my\":108},{\"lx\":144,\"ly\":108,\"mx\":146,\"my\":108},{\"lx\":142,\"ly\":110,\"mx\":144,\"my\":108},{\"lx\":139,\"ly\":110,\"mx\":142,\"my\":110},{\"lx\":133,\"ly\":111,\"mx\":139,\"my\":110},{\"lx\":130,\"ly\":111,\"mx\":133,\"my\":111},{\"lx\":126,\"ly\":111,\"mx\":130,\"my\":111},{\"lx\":121,\"ly\":113,\"mx\":126,\"my\":111},{\"lx\":116,\"ly\":114,\"mx\":121,\"my\":113},{\"lx\":110,\"ly\":114,\"mx\":116,\"my\":114},{\"lx\":105,\"ly\":115,\"mx\":110,\"my\":114},{\"lx\":101,\"ly\":115,\"mx\":105,\"my\":115},{\"lx\":96,\"ly\":115,\"mx\":101,\"my\":115},{\"lx\":92,\"ly\":115,\"mx\":96,\"my\":115},{\"lx\":90,\"ly\":115,\"mx\":92,\"my\":115},{\"lx\":88,\"ly\":115,\"mx\":90,\"my\":115},{\"lx\":87,\"ly\":114,\"mx\":88,\"my\":115},{\"lx\":86,\"ly\":112,\"mx\":87,\"my\":114},{\"lx\":85,\"ly\":110,\"mx\":86,\"my\":112},{\"lx\":85,\"ly\":108,\"mx\":85,\"my\":110},{\"lx\":85,\"ly\":104,\"mx\":85,\"my\":108},{\"lx\":85,\"ly\":99,\"mx\":85,\"my\":104},{\"lx\":85,\"ly\":90,\"mx\":85,\"my\":99},{\"lx\":89,\"ly\":75,\"mx\":85,\"my\":90},{\"lx\":96,\"ly\":60,\"mx\":89,\"my\":75},{\"lx\":102,\"ly\":47,\"mx\":96,\"my\":60},{\"lx\":112,\"ly\":34,\"mx\":102,\"my\":47},{\"lx\":125,\"ly\":24,\"mx\":112,\"my\":34},{\"lx\":138,\"ly\":17,\"mx\":125,\"my\":24},{\"lx\":151,\"ly\":13,\"mx\":138,\"my\":17},{\"lx\":164,\"ly\":12,\"mx\":151,\"my\":13},{\"lx\":174,\"ly\":12,\"mx\":164,\"my\":12},{\"lx\":184,\"ly\":12,\"mx\":174,\"my\":12},{\"lx\":192,\"ly\":12,\"mx\":184,\"my\":12},{\"lx\":199,\"ly\":12,\"mx\":192,\"my\":12},{\"lx\":204,\"ly\":15,\"mx\":199,\"my\":12},{\"lx\":209,\"ly\":17,\"mx\":204,\"my\":15},{\"lx\":212,\"ly\":19,\"mx\":209,\"my\":17},{\"lx\":215,\"ly\":22,\"mx\":212,\"my\":19},{\"lx\":218,\"ly\":24,\"mx\":215,\"my\":22},{\"lx\":219,\"ly\":26,\"mx\":218,\"my\":24},{\"lx\":221,\"ly\":28,\"mx\":219,\"my\":26},{\"lx\":222,\"ly\":31,\"mx\":221,\"my\":28},{\"lx\":223,\"ly\":35,\"mx\":222,\"my\":31},{\"lx\":223,\"ly\":38,\"mx\":223,\"my\":35},{\"lx\":224,\"ly\":41,\"mx\":223,\"my\":38},{\"lx\":224,\"ly\":46,\"mx\":224,\"my\":41},{\"lx\":224,\"ly\":51,\"mx\":224,\"my\":46},{\"lx\":224,\"ly\":55,\"mx\":224,\"my\":51},{\"lx\":224,\"ly\":58,\"mx\":224,\"my\":55},{\"lx\":222,\"ly\":62,\"mx\":224,\"my\":58},{\"lx\":222,\"ly\":63,\"mx\":222,\"my\":62},{\"lx\":220,\"ly\":65,\"mx\":222,\"my\":63},{\"lx\":219,\"ly\":66,\"mx\":220,\"my\":65},{\"lx\":218,\"ly\":67,\"mx\":219,\"my\":66},{\"lx\":217,\"ly\":68,\"mx\":218,\"my\":67},{\"lx\":215,\"ly\":68,\"mx\":217,\"my\":68},{\"lx\":215,\"ly\":69,\"mx\":215,\"my\":68},{\"lx\":213,\"ly\":69,\"mx\":215,\"my\":69},{\"lx\":212,\"ly\":69,\"mx\":213,\"my\":69},{\"lx\":210,\"ly\":69,\"mx\":212,\"my\":69},{\"lx\":208,\"ly\":70,\"mx\":210,\"my\":69},{\"lx\":206,\"ly\":70,\"mx\":208,\"my\":70},{\"lx\":204,\"ly\":71,\"mx\":206,\"my\":70},{\"lx\":201,\"ly\":71,\"mx\":204,\"my\":71},{\"lx\":199,\"ly\":72,\"mx\":201,\"my\":71},{\"lx\":196,\"ly\":73,\"mx\":199,\"my\":72},{\"lx\":192,\"ly\":73,\"mx\":196,\"my\":73},{\"lx\":190,\"ly\":73,\"mx\":192,\"my\":73},{\"lx\":188,\"ly\":73,\"mx\":190,\"my\":73},{\"lx\":185,\"ly\":73,\"mx\":188,\"my\":73},{\"lx\":183,\"ly\":73,\"mx\":185,\"my\":73},{\"lx\":180,\"ly\":73,\"mx\":183,\"my\":73},{\"lx\":176,\"ly\":72,\"mx\":180,\"my\":73},{\"lx\":174,\"ly\":72,\"mx\":176,\"my\":72},{\"lx\":171,\"ly\":71,\"mx\":174,\"my\":72},{\"lx\":170,\"ly\":71,\"mx\":171,\"my\":71},{\"lx\":169,\"ly\":70,\"mx\":170,\"my\":71},{\"lx\":168,\"ly\":70,\"mx\":169,\"my\":70},{\"lx\":168,\"ly\":69,\"mx\":168,\"my\":70},{\"lx\":168,\"ly\":68,\"mx\":168,\"my\":69},{\"lx\":169,\"ly\":68,\"mx\":168,\"my\":68}]";

        $img = sigJsonToImage(json_decode($json),["imageSize" => [300,160]]);
		$s = PrintForm::random_string('resources/imgsignat/',8,".png");
        imagepng($img, $s);
        imagedestroy($img);	
		// return redirect()->to(base_url("usuarios/index"));
	}
	public function barcode()
	{
		$generator = new BarcodeGeneratorPNG();
		$bc = $generator->getBarcode('19238', $generator::TYPE_KIX);
		file_put_contents('resources/imgsignat/barcode.png',$bc);

		echo '<img src="data:image/png;base64,' . base64_encode($bc) . '">';
	}
	public function sign()
	{
        $d["img"] = base_url("resources/imgsignat/signature.png");
		echo "<img src='" . $d["img"] . "' style='border: 5pt solid black;' />";
	}
	public function rcon()
	{
		if(!session()->get("IdUsu")) return redirect()->to('/login');
		$d = $this->data;
		$d["id"] = session()->get("IdUsu");
		return view('usuarios/chcon',$d);
	}

	public function submiteditar() //Editar Usuario
	{
		$p = $this->request->getVar();
		try {
			$b = $this->model->update($p["IdUsu"],$p);
			if($b) session()->setFlashdata(['msg' => 'Operación correcta','r' => true]);
			else session()->setFlashdata(['msg' => 'Operación Incorrecta','r' => false]);
		} catch (\Throwable $th) {
			session()->setFlashdata(['msg' => 'Operación Incorrecta','r' => false]);
		}
		return redirect()->to('/usuarios');
	}
	public function submitchcon() //Editar contraseña
	{
		$p = $this->request->getVar();
		if($p["pas1"] != $p["pas2"]){
			session()->setFlashdata(['msg' => 'Las contraseñas no coinciden','r' => false]);
			return redirect()->to('/usuarios/rcon');
		}
		try {
			$b = $this->model->update($p["IdUsu"],["ConUsu" => password_hash($p["pas2"], PASSWORD_DEFAULT)]);
			print_r($this->model->getLastQuery()->getQuery());
			if($b) session()->setFlashdata(['msg' => 'Contraseña actualizada','r' => true]);
			else session()->setFlashdata(['msg' => 'Error al actualizar','r' => false]);
		} catch (\Throwable $th) {
			session()->setFlashdata(['msg' => 'Puede que no haya conexión o haya un error en el servidor','r' => false]);
		}
		return redirect()->to('/usuarios');
	}
	public function ejajaxeditars() //Ajax ejemplo simple
	{
		$p = $this->request->getVar();
		$id = $this->request->getVar("IdAsis");
		$q = false;
		try {
			$bi = isset($p["IngAsis"]) && $p["IngAsis"]!="";
			$bs = isset($p["SalAsis"]) && $p["SalAsis"]!="";
			// echo ($bi?"i ex":"i nex")." ".($bs?"s ex":"s nex");
			// si ambos 1(Completa), si solo entrada 0(ingreso), si solo salida 2(salida sin entrada) 
			$p["EstAsis"] = ($bi && $bs? 1 :($bi && !$bs? 0 : 2));

			if(is_null($id) || empty($id)){ //Crear Nuevo Registro
				// Ver si el código de usuario
				$q = $this->model->insert($p);
				$id = $this->model->insertID();
				$nq = $this->model->find($id);
			}else{ //Actualizar
				$q = $this->model->update($id,$p);
				$nq = $this->model->find($id);
			}
			if($q)
				return $this->setResponseFormat('json')->respond(['r'=>true,'st'=>'Exito','m'=>"Operación Correcta", 'lid' => $id, 'nq' => $nq, 'p>' => $p]);
			else
				return $this->setResponseFormat('json')->respond(['r'=>false,'st'=>'Error','m'=>"Fallo en la operación"]);
			// Devolver éxito y su descripción
		} catch (\Throwable $th) {
			return $this->setResponseFormat('json')->respond(['r'=>false,'st'=>'Error','m'=>"Puede que haya un fallo en el servidor o que no haya conexión",'ex' => $th->getMessage()]);
		}
	}
	public function ejajaxeditar(){ //Ejemplo con transacciones
		$q = false;
		$id = $this->request->getVar("id");
		$idp = $this->request->getVar("idp");
		$mp = model("PersonalModel");
		try {
			$this->model->db->transStart(); // Ambas deben completarse
			$dta = $this->model->find($id); //Obtener datos de la asistencia
			$q2 = $mp
				->set("AcuPers","AcuPers + (".$dta["AcuAsis"].")",false)
				->set("TrabPers","TrabPers + (".$dta["TrabAsis"].")",false)
				->update($idp);
			$q = $this->model->update($id,["AcepAsis" => 1]);
			$this->model->db->transComplete();
			// print_r($this->model->getLastQuery()->getQuery());
			if($this->model->db->transStatus() === TRUE){
				$this->model->db->transCommit();
				return $this->setResponseFormat('json')->respond(['r'=>true,'st'=>'Exito','m'=>"Operación Correcta", 'lid' => $id]);
			}
			else{
				$this->model->db->transRollback();
				return $this->setResponseFormat('json')->respond(['r'=>false,'st'=>'Error','m'=>"Fallo en la operación"]);
			}
		} catch (\Throwable $th) {
			return $this->setResponseFormat('json')->respond(['r'=>false,'st'=>'Error','m'=>"Puede que haya un fallo en el servidor o que no haya conexión",'ex' => $th->getMessage()]);
		}
	}
	public function showkey()
	{
		// $e = Services::encrypter();
		// $v1 = $e->encrypt("NIGGA");
		// var_dump($v1);
		// echo $e->decrypt($v1);
		$key = bin2hex(\CodeIgniter\Encryption\Encryption::createKey(32));
		print_r($key); //usar hex2bin:<key> para almacenar

	}
}
