<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoginM extends Migration
{
	public function up()
	{
		// tusuarios
		$this->forge->addField([
			'IdTUsu'          => [
				'type'           => 'INT',
				'constraint'     => 11,	
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'NomTUsu' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Nombre del tipo de usuario',
			],
		]);
		$this->forge->addKey('IdTUsu', true);
		$this->forge->createTable('tusuarios',true);

		// Usuarios
		$this->forge->addField([
			'IdUsu' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'NomUsu' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Nombre completo del usuario',
			],
			'LogUsu' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Login del usuario con el que podrá ingresar al sistema',
			],
			'ConUsu' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'comment' => 'Contraseña cifrada',
			],
			'IdTUsu' => [
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'       => true,
				'comment' => 'Id del tipo de usuario',
			],
		]);
		$this->forge->addKey('IdUsu', true);
		$this->forge->addForeignKey('IdTUsu','tusuarios','IdTUsu');
		$this->forge->createTable('usuarios',true);

		// menus
		$this->forge->addField([
			'IdMenu'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'PadMenu' => [
				'type'       => 'INT',
				'constraint' => '11',
			],
			'NomMenu'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
			'SubMenu'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
			'IconMenu' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
			'UrlMenu' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
			'OrdMenu' => [
				'type'       => 'INT',
				'constraint' => '3',
				'default' => '1',
			],
			'EstMenu' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
		]);
		$this->forge->addKey('IdMenu', true);
		$this->forge->createTable('menus',true);

		// menus_tusuarios
		$this->forge->addField([
			'IdMenu'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'IdTUsu' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
			],
		]);
		$this->forge->addForeignKey('IdTUsu','tusuarios','IdTUsu');
		$this->forge->addForeignKey('IdMenu','menus','IdMenu');
		$this->forge->createTable('menus_tusuarios',true);
	}

	public function down()
	{
		
		// $this->forge->dropTable('menus_tusuarios',true);
		// $this->forge->dropTable('menus',true);
	}
}
