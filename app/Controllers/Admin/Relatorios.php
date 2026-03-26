<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PedidoModel;

class Relatorios extends BaseController
{
    public function vendas()
    {
        $pedidoModel = new PedidoModel();
        $inicio = $this->request->getGet('inicio') ?: date('Y-m-01');
        $fim = $this->request->getGet('fim') ?: date('Y-m-d');

        $resumoBase = $pedidoModel
            ->where('DATE(created_at) >=', $inicio)
            ->where('DATE(created_at) <=', $fim);

        $resumo = [
            'pedidos' => $resumoBase->countAllResults(false),
            'total_vendas' => (float) (($resumoBase->selectSum('total')->first()['total'] ?? 0)),
        ];

        $pedidos = $pedidoModel
            ->select('loja_pedidos.*, loja_clientes.nome AS cliente_nome')
            ->join('loja_clientes', 'loja_clientes.id = loja_pedidos.cliente_id')
            ->where('DATE(loja_pedidos.created_at) >=', $inicio)
            ->where('DATE(loja_pedidos.created_at) <=', $fim)
            ->orderBy('loja_pedidos.id', 'DESC')
            ->findAll();

        return view('admin/relatorios/vendas', compact('inicio', 'fim', 'resumo', 'pedidos'));
    }
}
