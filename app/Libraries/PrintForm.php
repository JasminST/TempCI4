<?php 
namespace App\Libraries;

class PrintForm {
    public static function println($tx, array $r, $t){ //Testear array
		if($t){
        	echo "<br><br>$tx: <pre>"; print_r($r); echo "</pre> <br><br>";
		}
    }
    public static function printtx($tx,$t){ //Testear array
		if($t){
        	echo "$tx\n";
		}
    }
	public static function printlq($model,$t){ // Testear query
		if($t){
        	echo "<br><br>LQ: <pre> ".$model->getLastQuery()->getQuery()." </pre> <br><br>";
		}
    }
	public static function fprintForm($input, $b, $dtreg)
	{
		$d = $b && isset($input["data"]["name"]);
		$s = "";
		switch ($input["type"]) {
			case 'select':
				$s .= "<label class='control-label col-form-label'> " . $input["label"] . " </label>";
				if (array_key_exists("disabled", $input) && $input["disabled"]) $input["data"]["disabled"] = true;
				$s .= '<div class="input-group">';
				$s .= form_dropdown(($d ? $input["data"]["name"] : ''), $input["options"], ($d ? $dtreg[$input["data"]["name"]] : ''), $input["data"]);
				$s .= '</div>';
				if (array_key_exists("valid-feed", $input)) $s .= '<div class="valid-feedback"> ' . $input["data"]["valid-feed"] . '</div>';
				if (array_key_exists("invalid-feed", $input)) $s .= '<div class="invalid-feedback"> ' . $input["data"]["invalid-feed"] . '</div>';
				break;
			case 'select2': //Para librería, select con grupos de options
				if (array_key_exists("disabled", $input) && $input["disabled"]) $input["data"]["disabled"] = true; //Si disabled añadir attr
				$input["data"]["value"] = ($d ? $dtreg[$input["data"]["name"]] : (isset($input["data"]["value"]) ? $input["data"]["value"] : '')); //Si existe name mostrar dato del reg
				
				// Generar input
				$s .= "<label class='control-label col-form-label'> " . $input["label"] . " </label>";
				$s .= '<div class="form-group">';
					$s2 = "";
					foreach ($input["data"] as $k => $v) $s2 .= " $k='$v' ";
					$s .= '<select class="form-control" placeholder="seleccionar" allowClear="false" style="width: 100%; height:36px;" '.$s2.'>';
						$s .= '<option value="">Seleccionar<option>';
						foreach ($input["options"] as $k => $g) {
							$s .= '<optgroup label="'.$k.'">';
								foreach ($g as $k1 => $v) {
									$s .= "<option value='$k1' ".($input["data"]["value"] == $k1?"selected":"").">$v</option>";
								}
							$s .= '</optgroup>';
						}
					$s .= '</select>';
				$s .= '</div>';

				if (array_key_exists("valid-feed", $input)) $s .= '<div class="valid-feedback"> ' . $input["data"]["valid-feed"] . '</div>';
				if (array_key_exists("invalid-feed", $input)) $s .= '<div class="invalid-feedback"> ' . $input["data"]["invalid-feed"] . '</div>';
				break;
			case 'input':
				if (array_key_exists("label", $input)) $s .= "<h4> " . $input["label"] . " </h4>";
				if (array_key_exists("disabled", $input) && $input["disabled"]) $input["data"]["disabled"] = true;
				$input["data"]["value"] = ($d ? $dtreg[$input["data"]["name"]] : (isset($input["data"]["value"]) ? $input["data"]["value"] : ''));
				$s .= '<div class="form-group">';
				if (array_key_exists("preigtext", $input)) $s .= "<span class='input-group-text'>" . $input["preigtext"] . "</span>";
				$s .= form_input($input["data"]);
				if (array_key_exists("posigtext", $input)) $s .= "<span class='input-group-text'>" . $input["posigtext"] . "</span>";
				$s .= '</div>';
				if (array_key_exists("valid-feed", $input)) $s .= '<div class="valid-feedback"> ' . $input["data"]["valid-feed"] . '</div>';
				if (array_key_exists("invalid-feed", $input)) $s .= '<div class="invalid-feedback"> ' . $input["data"]["invalid-feed"] . '</div>';
				break;
			case 'textarea':
				if (array_key_exists("label", $input)) $s .= "<label class='control-label col-form-label'> " . $input["label"] . " </label>";
				if (array_key_exists("disabled", $input) && $input["disabled"]) $input["data"]["disabled"] = true;
				$s .= '<div class="input-group">';
				$input["data"]["value"] = ($d ? $dtreg[$input["data"]["name"]] : (isset($input["data"]["value"]) ? $input["data"]["value"] : ''));
				$s .= '</div>';
				$s .= form_textarea($input["data"]);
				if (array_key_exists("valid-feed", $input)) $s .= '<div class="valid-feedback"> ' . $input["data"]["valid-feed"] . '</div>';
				if (array_key_exists("invalid-feed", $input)) $s .= '<div class="invalid-feedback"> ' . $input["data"]["invalid-feed"] . '</div>';
				break;
			case 'check':
				if ($d && $dtreg[$input["data"]["name"]]) $input["data"]["checked"] = "true";
				if (array_key_exists("disabled", $input) && $input["disabled"]) $input["data"]["disabled"] = true;
				$input["data"]["value"] = ($d ? $dtreg[$input["data"]["name"]] : (isset($input["data"]["value"]) ? $input["data"]["value"] : ''));
				$s .= form_input(["type" => "hidden", "name" => $input["data"]["name"], "id" => $input["data"]["id"], "value"=>$input["data"]["value"]]);
				if (array_key_exists("value",$input["data"]) && $input["data"]["value"] == 1) $input["data"]["checked"] = true;
				if (array_key_exists("class",$input["data"])) $input["data"]["class"] .= " chcls";
				$input["data"]["oinp"] = $input["data"]["id"];
				$input["data"]["name"].="ch";
				$input["data"]["id"].="ch";
				$s .= "<div class='form-check form-check-inline'>" . form_input($input["data"]);
				$s .= "<label class='form-check-label' for='" . $input["data"]["id"] . "'> " . $input["label"] . " </label></div>";
				break;
			case 'legend':
				$s .= "<legend> " . $input["label"] . " </legend>";
				break;
			case 'button':
				$dis = (array_key_exists("disabled", $input) && $input["disabled"] ? "disabled" : "");
				$lab = $input["label"];
				$ic = $input["icon"];
				$attrs = '';
				foreach ($input["data"] as $k => $v)
					$attrs .= " $k = '$v'";
				$s .= "<a $attrs $dis> $lab <span class='btn-label'><i class='$ic'></i></span> </a>";
				break;
			case 'text':
				$s .= $input["text"];
				break;
			case 'lcheck':
				$st = $input["state"]; //1> edit ini, 2> edit fin
				$s .= "<div class='row'>";
				foreach ($input['arr'] as $v) {
					$nom = $v[0]; //Nombre
					$ini = $v[1]; //CInicio
					$fin = $v[2]; //CFin
					$des = $v[3]; //Desc
					$si = '<input type="checkbox" name="'.$ini.'" id="'.$ini.'" class="filled-in chk-col material-inputs" '.($d && $dtreg[$ini] == 1 || !$b?"checked":"").' '.($st == 1 || $st == 3?"":"disabled").'>';
					$sf = '<input type="checkbox" name="'.$fin.'" id="'.$fin.'" class="filled-in chk-col material-inputs" '.($d && $dtreg[$fin] == 1?"checked":"").' '.($st == 2 || $st == 3?"":"disabled").'>';

					$s .= "<div class='".$input["subclass"]."'>";
						$s .= "<div class='form-group row'>";
							$s .= '<div class="col-md-8 col-sm-10"><label>'.$des.'</label></div>';
							$s .= '<div class="col-md-2 col-sm-1">'.$si.'<label for="'.$ini.'">I</label></div>';
							$s .= '<div class="col-md-2 col-sm-1">'.$sf.'<label for="'.$fin.'">F</label></div>';
						$s .= "</div>";
					$s .= "</div>";
				}
				$s .= "</div>";
				break;
		}
		return $s;
	}
	public static function printFormCard($li, $dtreg)
	{
		$li; //Lista de los inputs a imprimir
		$s = '
		<div class="card">
			<div class="card-body">
				<div class="row">
		';
		$w = 0;
		$b = isset($dtreg);
		// var_dump($li,$dtreg);
		foreach ($li as $input){
			if (($w + $input["wdth"]) > 12){ //Si se sobrepasan los 12 md o si es el inicio
				$s .= '
					</div>
					<div class="row">
				';
			}
			$w = (($w + $input["wdth"]) > 12 ? $input["wdth"] : $w + $input["wdth"]);
			$s .= '<div class="'.$input["class"] .'">';
			$s .= PrintForm::fprintForm($input, $b, ($b ? $dtreg : null));
			$s .= '</div>';
		}
		$s .= '
				</div>
			</div>
		</div>
		';
		echo $s;
	}
	//Fuente> https://stackoverflow.com/questions/19083175/generate-random-string-in-php-for-file-name
	public static function random_string($path,$length,$type) {
		$key = '';
		$keys = array_merge(range(0, 9), range('a', 'z'));
		for ($i = 0; $i < $length; $i++)
			$key .= $keys[array_rand($keys)];
		return $path.$key.$type;
	}	
}
