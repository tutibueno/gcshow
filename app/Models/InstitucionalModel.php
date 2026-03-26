<?php

namespace App\Models;

use CodeIgniter\Model;

class InstitucionalModel extends Model
{
    protected $table = 'institucional';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'quem_somos',
        'missao_valores',
        'equipe_organizadora',
        'contatos',
        'telefone_whatsapp',
        'instagram_url',
        'facebook_url',
        'youtube_url',
    ];

    protected $useTimestamps = true;
}
