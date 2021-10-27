<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FejM extends Migration
{
    public function up()
    {
		$this->forge->addField([
			'IdFej' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'FcreFej' => [
				'type'       => 'DATE',
				//'constraint' => '50',
			],
			'FmodiFej' => [
				'type'       => 'DATE',
				//'constraint' => '50',
			],
			'IdUsu' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addKey('IdFej', true);
		$this->forge->addForeignKey('IdUsu','usuarios','IdUsu');
		$this->forge->createTable('ctrl_fej',true);
        
    }

    public function down()
    {
        $this->forge->dropTable('ctrl_fej',true);
		// $this->forge->dropTable('menus',true);
    }
}
