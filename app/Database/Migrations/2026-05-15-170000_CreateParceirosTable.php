<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateParceirosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'site_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'instagram_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tipo' => [
                'type' => 'ENUM',
                'constraint' => ['premium', 'normal'],
                'default' => 'normal',
            ],
            'ordem' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'ativo' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['ativo', 'tipo', 'ordem']);
        $this->forge->createTable('parceiros');
    }

    public function down()
    {
        $this->forge->dropTable('parceiros');
    }
}
