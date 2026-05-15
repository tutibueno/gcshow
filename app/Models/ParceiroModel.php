<?php

namespace App\Models;

use CodeIgniter\Model;

class ParceiroModel extends Model
{
    protected $table = 'parceiros';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nome',
        'descricao',
        'logo',
        'site_url',
        'instagram_url',
        'tipo',
        'ordem',
        'ativo',
    ];

    protected $useTimestamps = true;

    protected $validationRules = [
        'nome' => 'required|min_length[2]|max_length[255]',
        'site_url' => 'permit_empty|valid_url_strict|max_length[255]',
        'instagram_url' => 'permit_empty|valid_url_strict|max_length[255]',
        'tipo' => 'required|in_list[premium,normal]',
        'ordem' => 'permit_empty|integer',
        'ativo' => 'permit_empty|in_list[0,1]',
    ];

    public function getPremiumParceiros(int $limit = 12): array
    {
        return $this->where('ativo', 1)
            ->where('tipo', 'premium')
            ->orderBy('ordem', 'ASC')
            ->orderBy('nome', 'ASC')
            ->limit($limit)
            ->findAll();
    }

    public function getAllActiveParceiros(): array
    {
        return $this->where('ativo', 1)
            ->orderBy('tipo', 'DESC')
            ->orderBy('ordem', 'ASC')
            ->orderBy('nome', 'ASC')
            ->findAll();
    }
}
