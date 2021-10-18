<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LoginS extends Seeder
{
	public function run()
	{
		// Limpiar
		$this->db->disableForeignKeyChecks();
		$this->db->query('TRUNCATE menus_tusuarios');
		$this->db->query('TRUNCATE tusuarios');
		$this->db->query('TRUNCATE menus');
		$this->db->query('TRUNCATE usuarios');
		$this->db->enableForeignKeyChecks();

		$all = [];
		$all["tusuarios"] = [
			"camps" => [
				'NomTUsu'
			],
			"data" => [
				['Trabajador'],
				['Jefe'],
				['Admin'],
			],
		];
		$all["menus"] = [
			"camps" => [
				'PadMenu','NomMenu','SubMenu','IconMenu','UrlMenu','OrdMenu','EstMenu'
			],
			"data" => [
				['0','PERSONAL','','ti-id-badge','','1','1'], //1 Personal
				['1','Diario','D','','dashs/diario','1','1'], //DASH 2,3
				['1','Mensual','M','','dashs/mensual','1','1'],
				['0','CRUD','','ti-id-badge','','1','1'], //4 Personal
				['4','Form Ejemplo','D','','ctrl_fej','1','1'], //CRUD 5
				['0','PERSONAL','','ti-id-badge','','1','1'], //6 Personal
				['4','Lista','l','','dashs/diario','1','1'], //CRUD 7
			],
		];
		$all["menus_tusuarios"] = [
			"camps" => [
				'IdMenu','IdTUsu'
			],
			"data" => [
				// TRAB
				['4','1',],
				['5','1',],
				// JEFE
				['1','2',],
				['2','2',],
				['3','2',],
				// ADMIN
				['6','3',],
				['7','3',],
			],
		];
		$all["usuarios"] = [
			"camps" => [
				'NomUsu','LogUsu','ConUsu','IdTUsu'
			],
			"data" => [
				// TRAB
				['TRAB 1','TRAB1',"Asdf1234","1"],
				// JEFE
				['JEFE 1','JEFE1',"Asdf1234","2"],
				// ADMIN
				['ADMIN 1','ADMIN1',"Asdf1234","3"],
				
			],
		];
		foreach ($all as $k => $tab){
			$camp = $tab['camps'];
			foreach ($tab['data'] as $r){
				$dt = [];
				$i = 0;
				foreach ($r as $c)
					$dt[$camp[$i ++]] = $c;
				$this->db->table($k)->insert($dt);
			}
		}
	}
}
