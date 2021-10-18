<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'usuarios';
	protected $primaryKey           = 'IdUsu';
	// protected $useAutoIncrement     = true;
	// protected $insertID             = 0;
	// protected $returnType           = 'array';
	// protected $useSoftDeletes       = false;
	// protected $protectFields        = true;
	protected $allowedFields 		= ['IdUsu','LogUsu'];

	// // Dates
	// protected $useTimestamps        = false;
	// protected $dateFormat           = 'datetime';
	// protected $createdField         = 'created_at';
	// protected $updatedField         = 'updated_at';
	// protected $deletedField         = 'deleted_at';

	// // Validation
	// protected $validationRules      = [];
	// protected $validationMessages   = [];
	// protected $skipValidation       = false;
	// protected $cleanValidationRules = true;

	// // Callbacks
	// protected $allowCallbacks       = true;
	// protected $beforeInsert         = [];
	// protected $afterInsert          = [];
	// protected $beforeUpdate         = [];
	// protected $afterUpdate          = [];
	// protected $beforeFind           = [];
	// protected $afterFind            = [];
	// protected $beforeDelete         = [];
	// protected $afterDelete          = [];

	// GET
    public function login($nom, $pas)
    {
        $e = \Config\Services::encrypter();
        $q = $this->select('IdUsu, NomUsu, t.IdTUsu, t.NomTUsu,ConUsu')
        ->join('tusuarios t','usuarios.IdTUsu = t.IdTUsu')
        // ->getWhere(['LogUsu' => $nom, 'ConUsu' => $pas],1);
        ->getWhere(['LogUsu' => $nom],1)
        ->getRowArray();
        // return (is_null($q)?null:(password_verify($pas, $q["ConUsu"])?$q:null)); //Activar para verificar contraseña utilizando hash
        return (is_null($q)?null:($pas == $q["ConUsu"]?$q:null));
    }

	public function getMenus()
    {
        $q = $this->db
            ->table('vmenu')
            ->getWhere(['IdTUsuario'=>session()->get('tUsuario')]);
        return $q;
    }
    public function getAllowedFields()
    {
        return $this->allowedFields;
    }
    public function getUser() //Datos del Usuario Actual
    {
        $id = session()->get('IdUsuario');
        $q = $this
            -> join("tusuarios","usuarios.tUsuario = tusuarios.IdTUsuario")
            -> find($id);
        return $q;
    }
    public function getList()
    {
        $id = session()->get('IdUsuario');
        $q = $this
            -> orderBy("fModUsuario",'desc')
            -> getWhere(["CreaUsuario"=>$id]);
        return $q;
    }
}
