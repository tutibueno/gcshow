<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoItemModel extends Model
{
    protected $table = 'loja_pedido_itens';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pedido_id',
        'produto_id',
        'variacao_id',
        'produto_nome',
        'variacao_nome',
        'sku',
        'quantidade',
        'preco_unitario',
        'subtotal',
    ];
    protected $useTimestamps = true;
}
