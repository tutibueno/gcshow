<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIngressosToEventos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('eventos', [
            'ingressos_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'imagem'
            ],
            'ingressos_texto' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'ingressos_url'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('eventos', ['ingressos_url', 'ingressos_texto']);
    }
}
