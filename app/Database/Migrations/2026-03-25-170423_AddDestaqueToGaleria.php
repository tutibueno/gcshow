<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDestaqueToGaleria extends Migration
{
    public function up()
    {
        $this->forge->addColumn('galeria', [
            'destaque' => [
                'type' => 'BOOLEAN',
                'default' => 0,
                'after' => 'titulo'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('galeria', 'destaque');
    }
}
