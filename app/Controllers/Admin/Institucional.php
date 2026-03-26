<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstitucionalModel;

class Institucional extends BaseController
{
    public function index()
    {
        $model = new InstitucionalModel();

        $data['institucional'] = $this->obterRegistro($model);

        return view('admin/institucional/index', $data);
    }

    public function salvar()
    {
        $model = new InstitucionalModel();
        $registro = $this->obterRegistro($model);

        $model->update($registro['id'], [
            'quem_somos' => $this->request->getPost('quem_somos'),
            'missao_valores' => $this->request->getPost('missao_valores'),
            'equipe_organizadora' => $this->request->getPost('equipe_organizadora'),
            'contatos' => $this->request->getPost('contatos'),
            'telefone_whatsapp' => $this->request->getPost('telefone_whatsapp'),
            'instagram_url' => $this->request->getPost('instagram_url'),
            'facebook_url' => $this->request->getPost('facebook_url'),
            'youtube_url' => $this->request->getPost('youtube_url'),
        ]);

        return redirect()->to('/admin/institucional');
    }

    private function obterRegistro(InstitucionalModel $model): array
    {
        $registro = $model->first();

        if ($registro) {
            return $registro;
        }

        $id = $model->insert([
            'quem_somos' => null,
            'missao_valores' => null,
            'equipe_organizadora' => null,
            'contatos' => null,
            'telefone_whatsapp' => null,
            'instagram_url' => null,
            'facebook_url' => null,
            'youtube_url' => null,
        ], true);

        return $model->find($id);
    }
}
