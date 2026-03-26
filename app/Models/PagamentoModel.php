<?php

namespace App\Models;

use CodeIgniter\Model;

class PagamentoModel extends Model
{
    protected $table = 'loja_pagamentos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pedido_id', 'transacao_id', 'gateway', 'metodo', 'status', 'valor', 'payload'];
    protected $useTimestamps = true;
}
