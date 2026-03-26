<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categorias extends BaseController
{
    public function index()
    {
        $model = new CategoriaModel();

        return view('admin/categorias/index', [
            'categorias' => $model->orderBy('ordem', 'ASC')->orderBy('nome', 'ASC')->findAll(),
        ]);
    }

    public function salvar()
    {
        $model = new CategoriaModel();

        $model->save([
            'nome' => $this->request->getPost('nome'),
            'slug' => url_title((string) $this->request->getPost('nome'), '-', true),
            'descricao' => $this->request->getPost('descricao'),
            'ativo' => $this->request->getPost('ativo') ?? 0,
            'ordem' => $this->request->getPost('ordem') ?: 0,
        ]);

        return redirect()->to('/admin/categorias');
    }

    public function atualizar($id)
    {
        $model = new CategoriaModel();

        $model->update($id, [
            'nome' => $this->request->getPost('nome'),
            'slug' => url_title((string) $this->request->getPost('nome'), '-', true),
            'descricao' => $this->request->getPost('descricao'),
            'ativo' => $this->request->getPost('ativo') ?? 0,
            'ordem' => $this->request->getPost('ordem') ?: 0,
        ]);

        return redirect()->to('/admin/categorias');
    }

    public function excluir($id)
    {
        (new CategoriaModel())->delete($id);
        return redirect()->to('/admin/categorias');
    }
}
