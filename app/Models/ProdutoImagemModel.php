<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoImagemModel extends Model
{
    protected $table = 'loja_produto_imagens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['produto_id', 'arquivo', 'ordem'];
    protected $useTimestamps = true;
}
