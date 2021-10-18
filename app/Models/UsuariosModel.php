<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'usuarios';
	protected $primaryKey           = 'IdUsu';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = false;
	// protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];


	public function getUser($id) //Datos del Usuario Actual
    {
        
        $q = $this
            -> join("tusuarios","usuarios.IdTUsu = tusuarios.IdTUsu")
            -> find($id);
        return $q;
    }
	public function getMenus()
    {
        $q = $this->db
            ->table('vmenu')
            ->getWhere(['IdTUsu'=>session()->get('IdTUsu')]);
        return $q;
    }
}
