<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoHistoricoModel extends Model
{
    protected $table = 'loja_pedido_historicos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pedido_id', 'status', 'descricao', 'created_at'];
    protected $useTimestamps = false;
}
