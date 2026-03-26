<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\ProdutoImagemModel;
use App\Models\ProdutoModel;
use App\Models\ProdutoVariacaoModel;

class Produtos extends BaseController
{
    public function index()
    {
        $model = new ProdutoModel();

        $produtos = $model
            ->select('loja_produtos.*, loja_categorias.nome AS categoria_nome')
            ->join('loja_categorias', 'loja_categorias.id = loja_produtos.categoria_id', 'left')
            ->orderBy('loja_produtos.id', 'DESC')
            ->findAll();

        return view('admin/produtos/index', ['produtos' => $produtos]);
    }

    public function criar()
    {
        return view('admin/produtos/criar', $this->formData());
    }

    public function salvar()
    {
        $produtoId = (new ProdutoModel())->insert($this->payloadProduto(), true);
        $this->salvarImagens((int) $produtoId);
        $this->salvarVariacoes((int) $produtoId);
        $this->atualizarEstoqueECapa((int) $produtoId);

        return redirect()->to('/admin/produtos');
    }

    public function editar($id)
    {
        $produtoModel = new ProdutoModel();
        $imagemModel = new ProdutoImagemModel();
        $variacaoModel = new ProdutoVariacaoModel();

        return view('admin/produtos/editar', $this->formData([
            'produto' => $produtoModel->find($id),
            'imagens' => $imagemModel->where('produto_id', $id)->orderBy('ordem', 'ASC')->findAll(),
            'variacoes' => $variacaoModel->where('produto_id', $id)->orderBy('id', 'ASC')->findAll(),
        ]));
    }

    public function atualizar($id)
    {
        (new ProdutoModel())->update($id, $this->payloadProduto());
        $this->salvarImagens((int) $id);
        $this->salvarVariacoes((int) $id, true);
        $this->atualizarEstoqueECapa((int) $id);

        return redirect()->to('/admin/produtos');
    }

    public function excluir($id)
    {
        (new ProdutoModel())->delete($id);
        return redirect()->to('/admin/produtos');
    }

    private function formData(array $extra = []): array
    {
        return array_merge([
            'categorias' => (new CategoriaModel())->where('ativo', 1)->orderBy('nome', 'ASC')->findAll(),
            'produto' => null,
            'imagens' => [],
            'variacoes' => [],
        ], $extra);
    }

    private function payloadProduto(): array
    {
        $nome = (string) $this->request->getPost('nome');

        return [
            'categoria_id' => $this->request->getPost('categoria_id') ?: null,
            'nome' => $nome,
            'slug' => url_title($nome, '-', true),
            'sku' => $this->request->getPost('sku') ?: null,
            'resumo' => $this->request->getPost('resumo'),
            'descricao' => $this->request->getPost('descricao'),
            'preco' => $this->normalizarDecimal($this->request->getPost('preco')),
            'preco_promocional' => $this->request->getPost('preco_promocional') !== '' ? $this->normalizarDecimal($this->request->getPost('preco_promocional')) : null,
            'estoque' => (int) ($this->request->getPost('estoque') ?: 0),
            'peso_gramas' => (int) ($this->request->getPost('peso_gramas') ?: 0),
            'altura_cm' => $this->normalizarDecimal($this->request->getPost('altura_cm')),
            'largura_cm' => $this->normalizarDecimal($this->request->getPost('largura_cm')),
            'comprimento_cm' => $this->normalizarDecimal($this->request->getPost('comprimento_cm')),
            'usa_variacoes' => $this->request->getPost('usa_variacoes') ?? 0,
            'ativo' => $this->request->getPost('ativo') ?? 0,
        ];
    }

    private function salvarImagens(int $produtoId): void
    {
        $imagemModel = new ProdutoImagemModel();
        $arquivos = $this->request->getFileMultiple('imagens');

        if (!$arquivos) {
            return;
        }

        $ordem = (int) $imagemModel->where('produto_id', $produtoId)->countAllResults();
        $diretorio = ROOTPATH . 'uploads/produtos/';

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        foreach ($arquivos as $arquivo) {
            if (!$arquivo || !$arquivo->isValid()) {
                continue;
            }

            $nomeWebp = uniqid('produto_', true) . '.webp';
            $caminho = $diretorio . $nomeWebp;

            \Config\Services::image()
                ->withFile($arquivo)
                ->convert(IMAGETYPE_WEBP)
                ->save($caminho, 80);

            $imagemModel->insert([
                'produto_id' => $produtoId,
                'arquivo' => $nomeWebp,
                'ordem' => $ordem++,
            ]);
        }
    }

    private function salvarVariacoes(int $produtoId, bool $resetar = false): void
    {
        $variacaoModel = new ProdutoVariacaoModel();
        $linhas = preg_split('/\r\n|\r|\n/', trim((string) $this->request->getPost('variacoes_texto')));

        if ($resetar) {
            $variacaoModel->where('produto_id', $produtoId)->delete();
        }

        foreach ($linhas as $linha) {
            if (trim($linha) === '') {
                continue;
            }

            [$nome, $tamanho, $cor, $estoque, $precoAdicional, $sku] = array_pad(array_map('trim', explode('|', $linha)), 6, null);

            $variacaoModel->insert([
                'produto_id' => $produtoId,
                'nome' => $nome ?: 'Variação',
                'tamanho' => $tamanho ?: null,
                'cor' => $cor ?: null,
                'estoque' => (int) ($estoque ?: 0),
                'preco_adicional' => $this->normalizarDecimal($precoAdicional),
                'sku' => $sku ?: null,
                'ativo' => 1,
            ]);
        }
    }

    private function atualizarEstoqueECapa(int $produtoId): void
    {
        $produtoModel = new ProdutoModel();
        $imagemModel = new ProdutoImagemModel();
        $variacaoModel = new ProdutoVariacaoModel();

        $produto = $produtoModel->find($produtoId);
        if (!$produto) {
            return;
        }

        $primeiraImagem = $imagemModel->where('produto_id', $produtoId)->orderBy('ordem', 'ASC')->first();

        if ((int) $produto['usa_variacoes'] === 1) {
            $estoque = $variacaoModel->selectSum('estoque')->where('produto_id', $produtoId)->first()['estoque'] ?? 0;
            $produtoModel->update($produtoId, [
                'estoque' => (int) $estoque,
                'imagem_capa' => $primeiraImagem['arquivo'] ?? $produto['imagem_capa'],
            ]);
            return;
        }

        $produtoModel->update($produtoId, [
            'imagem_capa' => $primeiraImagem['arquivo'] ?? $produto['imagem_capa'],
        ]);
    }

    private function normalizarDecimal($valor): float
    {
        $valor = trim((string) $valor);
        if ($valor === '') {
            return 0.0;
        }

        if (str_contains($valor, ',') && str_contains($valor, '.')) {
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
        } else {
            $valor = str_replace(',', '.', $valor);
        }

        return (float) $valor;
    }
}
