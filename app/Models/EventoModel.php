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
        'data_evento',
        'hora_inicio',
        'hora_fim',
        'local',
        'cidade',
        'estado',
        'imagem',
        'ingressos_url',
        'ingressos_texto',
        'destaque',
        'publicado'
    ];

    protected $useTimestamps = true;
}
