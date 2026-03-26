<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'loja_clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'telefone', 'documento'];
    protected $useTimestamps = true;
}
