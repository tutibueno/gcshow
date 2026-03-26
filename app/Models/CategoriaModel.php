<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'loja_categorias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'slug', 'descricao', 'ativo', 'ordem'];
    protected $useTimestamps = true;
}
