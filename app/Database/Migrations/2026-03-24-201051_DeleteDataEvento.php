<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeleteDataEvento extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('eventos', 'data_evento');
    }

    public function down()
    {
        //
    }
}
