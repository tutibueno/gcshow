<?php

namespace App\Models;

use CodeIgniter\Model;

class EventoModel extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'titulo',
        'descricao',
        'data_inicio',
        'data_fim',
        'hora_inicio',
        'hora_fim',
        'local',
        'cidade',
        'estado',
        'imagem',
        'ingressos_url',
        'ingressos_texto',
        'destaque',
        'publicado',
        'mapa_iframe'
    ];

    protected $useTimestamps = true;
}
