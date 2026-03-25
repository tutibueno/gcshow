<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMapaToEventos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('eventos', [
            'mapa_iframe' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'ingressos_texto'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('eventos', 'mapa_iframe');
    }
}
