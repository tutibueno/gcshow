<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\ClienteModel;
use App\Models\EnderecoModel;
use App\Models\PagamentoModel;
use App\Models\PedidoHistoricoModel;
use App\Models\PedidoItemModel;
use App\Models\PedidoModel;
use App\Models\ProdutoImagemModel;
use App\Models\ProdutoModel;
use App\Models\ProdutoVariacaoModel;

class Loja extends BaseController
{
    public function index()
    {
        $categoriaId = $this->request->getGet('categoria');
        $produtoModel = new ProdutoModel();

        $builder = $produtoModel
            ->select('loja_produtos.*, loja_categorias.nome AS categoria_nome')
            ->join('loja_categorias', 'loja_categorias.id = loja_produtos.categoria_id', 'left')
            ->where('loja_produtos.ativo', 1)
            ->orderBy('loja_produtos.id', 'DESC');

        if ($categoriaId) {
            $builder->where('loja_produtos.categoria_id', $categoriaId);
        }

        return view('loja/index', [
            'categorias' => (new CategoriaModel())->where('ativo', 1)->orderBy('ordem', 'ASC')->findAll(),
            'produtos' => $builder->findAll(),
            'categoria_atual' => $categoriaId,
        ]);
    }

    public function detalhes($slug)
    {
        $produtoModel = new ProdutoModel();
        $produto = $produtoModel->where('slug', $slug)->where('ativo', 1)->first();

        if (!$produto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('loja/detalhes', [
            'produto' => $produto,
            'imagens' => (new ProdutoImagemModel())->where('produto_id', $produto['id'])->orderBy('ordem', 'ASC')->findAll(),
            'variacoes' => (new ProdutoVariacaoModel())->where('produto_id', $produto['id'])->where('ativo', 1)->findAll(),
        ]);
    }

    public function carrinho()
    {
        return view('loja/carrinho', $this->dadosCarrinho());
    }

    public function adicionarCarrinho()
    {
        $produto = (new ProdutoModel())->find($this->request->getPost('produto_id'));
        if (!$produto || (int) $produto['ativo'] !== 1) {
            return redirect()->back();
        }

        $variacaoId = $this->request->getPost('variacao_id') ?: null;
        $variacao = $variacaoId ? (new ProdutoVariacaoModel())->find($variacaoId) : null;
        $quantidade = max(1, (int) $this->request->getPost('quantidade'));
        $precoBase = $produto['preco_promocional'] ?: $produto['preco'];
        $precoFinal = (float) $precoBase + (float) ($variacao['preco_adicional'] ?? 0);
        $chave = $produto['id'] . ':' . ($variacaoId ?: '0');

        $cart = session()->get('loja_cart') ?? [];
        if (isset($cart[$chave])) {
            $cart[$chave]['quantidade'] += $quantidade;
            $cart[$chave]['subtotal'] = $cart[$chave]['quantidade'] * $cart[$chave]['preco_unitario'];
        } else {
            $cart[$chave] = [
                'chave' => $chave,
                'produto_id' => $produto['id'],
                'slug' => $produto['slug'],
                'nome' => $produto['nome'],
                'imagem_capa' => $produto['imagem_capa'],
                'variacao_id' => $variacaoId,
                'variacao_nome' => $variacao['nome'] ?? null,
                'quantidade' => $quantidade,
                'preco_unitario' => $precoFinal,
                'subtotal' => $quantidade * $precoFinal,
            ];
        }

        session()->set('loja_cart', $cart);
        return redirect()->to('/loja/carrinho');
    }

    public function removerCarrinho()
    {
        $chave = (string) $this->request->getPost('chave');
        $cart = session()->get('loja_cart') ?? [];
        unset($cart[$chave]);
        session()->set('loja_cart', $cart);

        return redirect()->to('/loja/carrinho');
    }

    public function calcularFrete()
    {
        $cep = preg_replace('/\D+/', '', (string) $this->request->getPost('cep'));
        $subtotal = $this->dadosCarrinho()['subtotal'];
        $frete = $cep === '' ? 0 : ($subtotal >= 300 ? 19.90 : 29.90);

        session()->set('loja_frete', [
            'cep' => $cep,
            'valor' => $frete,
            'metodo' => 'Correios/Sob consulta',
        ]);

        return redirect()->to('/loja/carrinho');
    }

    public function checkout()
    {
        $dados = $this->dadosCarrinho();
        if (empty($dados['itens'])) {
            return redirect()->to('/loja');
        }

        return view('loja/checkout', $dados);
    }

    public function finalizarPedido()
    {
        $dados = $this->dadosCarrinho();
        if (empty($dados['itens'])) {
            return redirect()->to('/loja');
        }

        $clienteModel = new ClienteModel();
        $enderecoModel = new EnderecoModel();
        $pedidoModel = new PedidoModel();
        $pedidoItemModel = new PedidoItemModel();
        $historicoModel = new PedidoHistoricoModel();
        $pagamentoModel = new PagamentoModel();
        $produtoModel = new ProdutoModel();
        $variacaoModel = new ProdutoVariacaoModel();

        $email = (string) $this->request->getPost('email');
        $cliente = $clienteModel->where('email', $email)->first();
        if (!$cliente) {
            $clienteId = $clienteModel->insert([
                'nome' => $this->request->getPost('nome'),
                'email' => $email,
                'telefone' => $this->request->getPost('telefone'),
                'documento' => $this->request->getPost('documento'),
            ], true);
        } else {
            $clienteId = $cliente['id'];
            $clienteModel->update($clienteId, [
                'nome' => $this->request->getPost('nome'),
                'telefone' => $this->request->getPost('telefone'),
                'documento' => $this->request->getPost('documento'),
            ]);
        }

        $enderecoId = $enderecoModel->insert([
            'cliente_id' => $clienteId,
            'apelido' => 'Entrega',
            'cep' => $this->request->getPost('cep'),
            'logradouro' => $this->request->getPost('logradouro'),
            'numero' => $this->request->getPost('numero'),
            'complemento' => $this->request->getPost('complemento'),
            'bairro' => $this->request->getPost('bairro'),
            'cidade' => $this->request->getPost('cidade'),
            'estado' => $this->request->getPost('estado'),
            'principal' => 1,
        ], true);

        $numeroPedido = 'PED' . date('YmdHis');
        $metodoPagamento = (string) $this->request->getPost('metodo_pagamento');

        $pedidoId = $pedidoModel->insert([
            'numero' => $numeroPedido,
            'cliente_id' => $clienteId,
            'endereco_id' => $enderecoId,
            'status' => 'aguardando_pagamento',
            'status_pagamento' => 'pendente',
            'metodo_pagamento' => $metodoPagamento,
            'metodo_envio' => $dados['frete_info']['metodo'] ?? 'Sob consulta',
            'subtotal' => $dados['subtotal'],
            'frete' => $dados['frete'],
            'desconto' => 0,
            'total' => $dados['total'],
            'observacoes' => $this->request->getPost('observacoes'),
        ], true);

        foreach ($dados['itens'] as $item) {
            $variacao = $item['variacao_id'] ? $variacaoModel->find($item['variacao_id']) : null;

            $pedidoItemModel->insert([
                'pedido_id' => $pedidoId,
                'produto_id' => $item['produto_id'],
                'variacao_id' => $item['variacao_id'] ?: null,
                'produto_nome' => $item['nome'],
                'variacao_nome' => $item['variacao_nome'],
                'sku' => $variacao['sku'] ?? null,
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco_unitario'],
                'subtotal' => $item['subtotal'],
            ]);

            if ($variacao) {
                $variacaoModel->update($variacao['id'], [
                    'estoque' => max(0, (int) $variacao['estoque'] - (int) $item['quantidade']),
                ]);
            } else {
                $produto = $produtoModel->find($item['produto_id']);
                if ($produto) {
                    $produtoModel->update($produto['id'], [
                        'estoque' => max(0, (int) $produto['estoque'] - (int) $item['quantidade']),
                    ]);
                }
            }
        }

        $historicoModel->insert([
            'pedido_id' => $pedidoId,
            'status' => 'aguardando_pagamento',
            'descricao' => 'Pedido criado pelo checkout da loja.',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $pagamentoModel->insert([
            'pedido_id' => $pedidoId,
            'metodo' => $metodoPagamento,
            'status' => 'pendente',
            'valor' => $dados['total'],
            'gateway' => 'integracao_pendente',
            'payload' => json_encode(['origem' => 'checkout_local']),
        ]);

        session()->remove('loja_cart');
        session()->remove('loja_frete');
        session()->setFlashdata('pedido_sucesso', $numeroPedido);

        return redirect()->to('/loja/meus-pedidos?email=' . urlencode($email));
    }

    public function meusPedidos()
    {
        $email = (string) ($this->request->getGet('email') ?: $this->request->getPost('email'));
        $pedidos = [];

        if ($email !== '') {
            $pedidos = (new PedidoModel())
                ->select('loja_pedidos.*, loja_clientes.nome AS cliente_nome, loja_clientes.email AS cliente_email')
                ->join('loja_clientes', 'loja_clientes.id = loja_pedidos.cliente_id')
                ->where('loja_clientes.email', $email)
                ->orderBy('loja_pedidos.id', 'DESC')
                ->findAll();
        }

        return view('loja/meus_pedidos', [
            'email' => $email,
            'pedidos' => $pedidos,
            'pedido_sucesso' => session()->getFlashdata('pedido_sucesso'),
        ]);
    }

    private function dadosCarrinho(): array
    {
        $itens = array_values(session()->get('loja_cart') ?? []);
        $subtotal = 0;

        foreach ($itens as $item) {
            $subtotal += (float) $item['subtotal'];
        }

        $freteInfo = session()->get('loja_frete') ?? ['valor' => 0, 'cep' => null, 'metodo' => null];
        $frete = (float) ($freteInfo['valor'] ?? 0);

        return [
            'itens' => $itens,
            'subtotal' => $subtotal,
            'frete' => $frete,
            'total' => $subtotal + $frete,
            'frete_info' => $freteInfo,
        ];
    }
}
