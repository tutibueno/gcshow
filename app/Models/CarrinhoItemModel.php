<?php

namespace App\Models;

use CodeIgniter\Model;

class CarrinhoItemModel extends Model
{
    protected $table = 'loja_carrinho_itens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['carrinho_id', 'produto_id', 'variacao_id', 'quantidade', 'preco_unitario', 'subtotal'];
    protected $useTimestamps = true;
}
