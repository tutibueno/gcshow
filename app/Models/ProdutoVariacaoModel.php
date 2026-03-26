<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoVariacaoModel extends Model
{
    protected $table = 'loja_produto_variacoes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'produto_id',
        'sku',
        'nome',
        'tamanho',
        'cor',
        'preco_adicional',
        'estoque',
        'ativo',
    ];
    protected $useTimestamps = true;
}
