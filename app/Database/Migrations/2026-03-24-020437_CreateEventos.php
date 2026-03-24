<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEventos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'data_evento' => [
                'type' => 'DATE',
            ],
            'hora_inicio' => [
                'type' => 'TIME',
            ],
            'hora_fim' => [
                'type' => 'TIME',
            ],
            'local' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'cidade' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
            ],
            'imagem' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'destaque' => [
                'type' => 'BOOLEAN',
                'default' => 0,
            ],
            'publicado' => [
                'type' => 'BOOLEAN',
                'default' => 1,
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
        $this->forge->createTable('eventos');
    }

    public function down()
    {
        $this->forge->dropTable('eventos');
    }
}
