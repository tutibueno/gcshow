<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGaleria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'evento_id' => [
                'type' => 'INT',
            ],
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => 20, // foto ou video
            ],
            'arquivo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'video_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
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
        $this->forge->addForeignKey('evento_id', 'eventos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('galeria');
    }

    public function down()
    {
        $this->forge->dropTable('galeria');
    }
}
