<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInstitucional extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'quem_somos' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'missao_valores' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'equipe_organizadora' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'contatos' => [
                'type' => 'TEXT',
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
        $this->forge->createTable('institucional');

        $this->db->table('institucional')->insert([
            'quem_somos' => null,
            'missao_valores' => null,
            'equipe_organizadora' => null,
            'contatos' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('institucional');
    }
}
