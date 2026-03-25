<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriaModel;
use App\Models\EventoModel;

class Galeria extends BaseController
{
    public function index()
    {
        $galeriaModel = new GaleriaModel();
        $eventoModel = new EventoModel();

        $data['galeria'] = $galeriaModel
            ->select('galeria.*, eventos.titulo as evento')
            ->join('eventos', 'eventos.id = galeria.evento_id')
            ->orderBy('galeria.id', 'DESC')
            ->findAll();

        $data['eventos'] = $eventoModel->findAll();

        return view('admin/galeria/index', $data);
    }

    public function salvar()
    {
        $model = new GaleriaModel();

        $tipo = $this->request->getPost('tipo');
        $arquivo = null;
        $videoUrl = null;

        if ($tipo == 'foto') {
            $img = $this->request->getFile('arquivo');

            if ($img && $img->isValid()) {

                $nomeWebp = uniqid() . '.webp';
                $caminho = 'uploads/galeria/' . $nomeWebp;

                // Converter para WEBP
                $image = \Config\Services::image()
                    ->withFile($img)
                    ->convert(IMAGETYPE_WEBP)
                    ->save($caminho, 80);

                $arquivo = $nomeWebp;
            }
        }

        if ($tipo == 'video') {
            $videoUrl = $this->request->getPost('video_url');
        }

        $model->save([
            'evento_id' => $this->request->getPost('evento_id'),
            'tipo' => $tipo,
            'arquivo' => $arquivo,
            'video_url' => $videoUrl,
            'titulo' => $this->request->getPost('titulo'),
            'destaque' => $this->request->getPost('destaque') ?? 0,
        ]);

        return redirect()->to('/admin/galeria');
    }

    public function excluir($id)
    {
        $model = new GaleriaModel();
        $model->delete($id);

        return redirect()->to('/admin/galeria');
    }
}
