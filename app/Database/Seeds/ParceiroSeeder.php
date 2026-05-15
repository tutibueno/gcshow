<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ParceiroSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('parceiros')->insertBatch([
            [
                'nome' => 'Parceiro Premium',
                'descricao' => 'Parceiro de destaque do Game Collection Show.',
                'logo' => null,
                'site_url' => 'https://example.com',
                'instagram_url' => null,
                'tipo' => 'premium',
                'ordem' => 1,
                'ativo' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nome' => 'Parceiro Normal',
                'descricao' => 'Parceiro apoiador do evento.',
                'logo' => null,
                'site_url' => 'https://example.org',
                'instagram_url' => null,
                'tipo' => 'normal',
                'ordem' => 2,
                'ativo' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
