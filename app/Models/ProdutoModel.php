<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table = 'loja_produtos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'categoria_id',
        'nome',
        'slug',
        'sku',
        'resumo',
        'descricao',
        'imagem_capa',
        'preco',
        'preco_promocional',
        'estoque',
        'peso_gramas',
        'altura_cm',
        'largura_cm',
        'comprimento_cm',
        'usa_variacoes',
        'ativo',
    ];
    protected $useTimestamps = true;
}
