<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PedidoHistoricoModel;
use App\Models\PedidoItemModel;
use App\Models\PedidoModel;

class Pedidos extends BaseController
{
    public function index()
    {
        $pedidos = (new PedidoModel())
            ->select('loja_pedidos.*, loja_clientes.nome AS cliente_nome, loja_clientes.email AS cliente_email')
            ->join('loja_clientes', 'loja_clientes.id = loja_pedidos.cliente_id')
            ->orderBy('loja_pedidos.id', 'DESC')
            ->findAll();

        return view('admin/pedidos/index', ['pedidos' => $pedidos]);
    }

    public function detalhes($id)
    {
        $pedidoModel = new PedidoModel();
        $pedido = $pedidoModel
            ->select('loja_pedidos.*, loja_clientes.nome AS cliente_nome, loja_clientes.email AS cliente_email, loja_clientes.telefone AS cliente_telefone')
            ->join('loja_clientes', 'loja_clientes.id = loja_pedidos.cliente_id')
            ->find($id);

        return view('admin/pedidos/detalhes', [
            'pedido' => $pedido,
            'itens' => (new PedidoItemModel())->where('pedido_id', $id)->findAll(),
            'historico' => (new PedidoHistoricoModel())->where('pedido_id', $id)->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function atualizarStatus($id)
    {
        $status = (string) $this->request->getPost('status');
        $statusPagamento = (string) $this->request->getPost('status_pagamento');

        (new PedidoModel())->update($id, [
            'status' => $status,
            'status_pagamento' => $statusPagamento,
            'codigo_rastreio' => $this->request->getPost('codigo_rastreio') ?: null,
        ]);

        (new PedidoHistoricoModel())->insert([
            'pedido_id' => $id,
            'status' => $status,
            'descricao' => $this->request->getPost('descricao') ?: 'Status atualizado pelo painel administrativo.',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/pedidos/' . $id);
    }
}
