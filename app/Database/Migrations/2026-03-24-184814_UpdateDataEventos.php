<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateDataEventos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('eventos', [
            'data_inicio' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'descricao'
            ],
            'data_fim' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'data_inicio'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('eventos', ['data_inicio', 'data_fim']);
    }
}