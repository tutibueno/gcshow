<?php

namespace App\Models;

use CodeIgniter\Model;

class EnderecoModel extends Model
{
    protected $table = 'loja_enderecos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'cliente_id',
        'apelido',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'principal',
    ];
    protected $useTimestamps = true;
}
