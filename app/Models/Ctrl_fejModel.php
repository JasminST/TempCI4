<?php 
namespace App\Models;

use CodeIgniter\Model;

class Ctrl_fejModel extends Model{
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $DBGroup              = 'default';
    protected $table      = 'ctrl_fej';
	protected $primaryKey           = 'IdFej';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = false;
	protected $allowedFields        = ['FcreFej', 'FmodiFej', 'IdUsu'];


}