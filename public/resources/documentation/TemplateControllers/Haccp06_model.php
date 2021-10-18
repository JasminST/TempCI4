<?php

class Haccp06_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->camps = ["iCodiSalm", "dModiSalm", "dCreaSalm", "cTipoSalm", "dPiniSalm", "dPfinSalm", "dPeriSalm", "dPremSalm", "dCiclSalm", "dVelfSalm", "dAltuSalm", "dRabaSalm", "dRarrSalm", "dTpmeSalm", "cObsSalm", "cAcoSalm"];
    $this->pdfcamps = ["cTipoSalm", "dPiniSalm", "dPfinSalm", "dPeriSalm", "dPremSalm", "dCiclSalm", "dVelfSalm", "dAltuSalm", "dRabaSalm", "dRarrSalm", "dTpmeSalm"];
    $s = "";
    $pdfs = "";
    $regs = "";
    $cm = array();
    foreach ($this->camps as $k => $v){
      $s .= ($k == 0 ? "" : ",").($k==2?"date($v) as dCreaSalm":$v);
      $regs .= ($k == 0 ? "" : ",")."$v as c$k";
      $cm["c".$k] = $v;
    }
    foreach ($this->pdfcamps as $k => $v)
      $pdfs .= ($k == 0 ? "" : ",")."$v as c$k";
    
    $this->dcamps = $s; //Todos los campos como un string
    $this->rcamps = $regs; //Todos los campos como un string pero sin los nombres de la BD
    $this->pdfdcamps = $pdfs; //Todos los campos para el pdf como string
    $this->ccamps = $cm; //Todos los campos como asociativo (para el formulario)
    $this->tab = "haccp06";
    $this->crea = $this->camps[2];
    $this->modi = $this->camps[1];
    $this->codi = $this->camps[0];
  }

  //datatables por usuario ordenado por la fecha de modificacion
  public function getList($idu) //Obtener todos los datos de la lista
  {
    $d = $this->dcamps;
    $this->db
      ->select($d)
      ->from($this->tab." as h")
      ->join("usuario as u", 'h.iCodUsuario = u.iCodUsuario')
      ->where("h.iCodUsuario", $idu);
    $query = $this->db->order_by($this->modi, "desc")->get();
    //echo $this->db->last_query();
    //exit();
    return $query;
  }
  public function getDList($id, $dia) //Obtener datos del día
  {
    $this->db
      ->select($this->dcamps)
      ->from($this->tab." as h")
      ->join("usuario", 'h.iCodUsuario = usuario.iCodUsuario')
      ->where(array("h.iCodUsuario" => $id, 'DATE('.$this->crea.')' => $dia));
    $query = $this->db->order_by($this->crea, "desc")->get();
    //exit();
    return $query;
  }
  public function getReg($id) //Obtener datos de un registro
  {
    $query = $this->db->select("DATE($this->crea) AS fecha, u.cNomUsuario, $this->rcamps")
      ->from($this->tab." as h")
      ->join("usuario u", 'h.iCodUsuario = u.iCodUsuario')
      ->where($this->codi, $id)->get();
    return $query;
  }

  // PDF
  public function getRegPdf($idu, $dia)
  {
    $query = $this->db
      ->select("time($this->crea) as ch, $this->pdfdcamps")
      ->from("$this->tab as h")
      ->where(array("h.iCodUsuario" => $idu, 'DATE('.$this->crea.')' => $dia))
      ->order_by($this->crea, "desc")
      ->get();
    return $query;
  }

  public function getLfec($id, $dia) // Obtener la última fecha
  {
    $query = $this->db
      ->select("max(dCreaSalm) as last")
      ->from($this->tab." as h")
      ->where(array("h.iCodUsuario" => $id, 'DATE('.$this->crea.')' => $dia))
      ->get();
    //echo $this->db->last_query();
    //exit();
    return $query->row();
  }

  public function getObs($id, $dia)
  { //retorna observaciones y acciones del día
    $query = $this->db
      ->select("cObsSalm, cAcoSalm")
      ->from($this->tab." as h")
      ->where(array("h.iCodUsuario" => $id, 'DATE('.$this->crea.')' => $dia))
      ->order_by($this->crea, 'desc')
      ->get();
    //echo $this->db->last_query();
    //exit();
    return $query;
  }

  public function getNusu($idu)
  { //retorna la última hora del día
    $query = $this->db
      ->select("concat(u.cNbrUsuario,' ',u.cApeUsuario) as nusu")
      ->from("usuario as u")
      ->where("iCodUsuario", $idu)
      ->get();
    //echo $this->db->last_query();
    //exit();
    return $query->row();
  }
  // CRUD
  public function createRegistro($data)
  {
    $query = $this->db->insert($this->tab, $data);
    // NOTIFICACIONES
    return $query;
    $last_id = $this->db->insert_id();
    // print_r($data);
    $r = 0;
    $evals = array(
      array(
        'v1' => 5,
        'r' => "Se sobrepasó el límite #r/5 en el grupo 1.4-1.6",
        'e' => "(\$data['d14161TempEnfr'] + \$data['d14162TempEnfr'] + \$data['d14163TempEnfr'])/3",
        'ti' => "Temperatura 1.4-1.6",
        't' => 1
      )
    );
    foreach ($evals as $row) {
      $e = $row['e'];
      $v1 = $row['v1'];
      eval("\$r = round($e,2);");
      $b = false;
      switch ($row['t']) {
        case 1:
          eval("\$b = \$r > \$v1;");
          break;
      }
      if ($b) {
        $dn = array(
          'cTexNoti' => str_replace('#r', $r, $row['r']),
          'dFecNoti' => date('Y-m-d H:i:s'),
          'iPriNoti' => 1,
          'iEstNoti' => 0,
          'cTtlNoti' => $row['ti'],
          'cTabNoti' => 'Haccp05',
          'cUrlNoti' => 'appover_ofi/haccp05temp',
          'iCodUsuarioCrea' => $this->session->userdata("idusuario"),
          'iCodUsuario' => $this->session->userdata("icusuario"),
          'iIdcNoti' => $last_id
        );
        $this->db->insert('notificacion', $dn);
      }
    }
  }
  public function chRegistro($id, $data)
  {
    $this->db->where($this->codi, $id);
    $query = $this->db->update($this->tab, $data);
    return $query;
  }
  public function deleteRegistro($id)
  {
    $query = $this->db->delete($this->tab, array($this->codi => $id));
    return $query;
  }
}
