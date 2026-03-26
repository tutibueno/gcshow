<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRedesSociaisToInstitucional extends Migration
{
    public function up()
    {
        $this->forge->addColumn('institucional', [
            'telefone_whatsapp' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
                'after' => 'contatos',
            ],
            'instagram_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'telefone_whatsapp',
            ],
            'facebook_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'instagram_url',
            ],
            'youtube_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'facebook_url',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('institucional', [
            'telefone_whatsapp',
            'instagram_url',
            'facebook_url',
            'youtube_url',
        ]);
    }
}
