<?php

namespace App\Models;

use CodeIgniter\Model;

class CarrinhoModel extends Model
{
    protected $table = 'loja_carrinhos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sessao_id', 'cliente_id', 'subtotal', 'frete', 'total'];
    protected $useTimestamps = true;
}
