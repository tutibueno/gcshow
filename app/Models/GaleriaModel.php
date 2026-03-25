<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriaModel extends Model
{
    protected $table = 'galeria';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'evento_id',
        'tipo',
        'arquivo',
        'video_url',
        'titulo',
        'destaque'
    ];


    protected $useTimestamps = true;
}
