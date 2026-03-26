<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table = 'loja_pedidos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'numero',
        'cliente_id',
        'endereco_id',
        'status',
        'status_pagamento',
        'metodo_pagamento',
        'metodo_envio',
        'subtotal',
        'frete',
        'desconto',
        'total',
        'observacoes',
        'codigo_rastreio',
    ];
    protected $useTimestamps = true;
}
