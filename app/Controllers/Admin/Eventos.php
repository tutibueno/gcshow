<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventoModel;
use App\Models\GaleriaModel;

class Eventos extends BaseController
{
    public function index()
    {
        $model = new EventoModel();
        $eventos = $model->orderBy('data_inicio', 'DESC')->findAll();

        $fotosPorEvento = [];
        $totaisGaleria = (new GaleriaModel())
            ->select('evento_id, COUNT(*) as total_fotos')
            ->groupBy('evento_id')
            ->findAll();

        foreach ($totaisGaleria as $item) {
            $fotosPorEvento[(int) $item['evento_id']] = (int) $item['total_fotos'];
        }

        foreach ($eventos as &$evento) {
            $evento['total_fotos'] = $fotosPorEvento[(int) $evento['id']] ?? 0;
        }
        unset($evento);

        $data['eventos'] = $eventos;

        return view('admin/eventos/index', $data);
    }

    public function criar()
    {
        return view('admin/eventos/criar');
    }

    public function salvar()
    {
        $model = new EventoModel();

        $imagem = $this->request->getFile('imagem');
        $nomeImagem = null;

        if ($imagem && $imagem->isValid()) {
            $nomeImagem = $imagem->getRandomName();
            $imagem->move('uploads/eventos', $nomeImagem);

            if ($imagem && $imagem->isValid()) {

                $nomeWebp = uniqid() . '.webp';
                $caminho = 'uploads/galeria/' . $nomeWebp;

                // Converter para WEBP
                $image = \Config\Services::image()
                    ->withFile($imagem)
                    ->fit(1920, 800, 'center')
                    ->convert(IMAGETYPE_WEBP)
                    ->save($caminho, 80);

                $nomeImagem = $nomeWebp;
            }

        }

        $model->save([
            'titulo' => $this->request->getPost('titulo'),
            'descricao' => $this->request->getPost('descricao'),
            'data_inicio' => $this->request->getPost('data_inicio'),
            'data_fim' => $this->request->getPost('data_fim'),
            'hora_inicio' => $this->request->getPost('hora_inicio'),
            'hora_fim' => $this->request->getPost('hora_fim'),
            'local' => $this->request->getPost('local'),
            'cidade' => $this->request->getPost('cidade'),
            'estado' => $this->request->getPost('estado'),
            'ingressos_url' => $this->request->getPost('ingressos_url'),
            'ingressos_texto' => $this->request->getPost('ingressos_texto'),
            'mapa_iframe' => $this->request->getPost('mapa_iframe'),
            'destaque' => $this->request->getPost('destaque') ?? 0,
            'publicado' => $this->request->getPost('publicado') ?? 0,
            'imagem' => $nomeImagem
        ]);

        return redirect()->to('/admin/eventos');
    }

    public function editar($id)
    {
        $model = new EventoModel();
        $data['evento'] = $model->find($id);

        return view('admin/eventos/editar', $data);
    }

    public function atualizar($id)
    {
        $model = new EventoModel();

        $imagem = $this->request->getFile('imagem');
        $nomeImagem = $this->request->getPost('imagem_atual');

        if ($imagem && $imagem->isValid()) {
            $nomeImagem = $imagem->getRandomName();
            $imagem->move('uploads/eventos', $nomeImagem);

            if ($imagem && $imagem->isValid()) {

                $nomeWebp = uniqid() . '.webp';
                $caminho = 'uploads/galeria/' . $nomeWebp;

                // Converter para WEBP
                $image = \Config\Services::image()
                    ->withFile($imagem)
                    ->fit(1920, 800, 'center')
                    ->convert(IMAGETYPE_WEBP)
                    ->save($caminho, 80);

                $nomeImagem = $nomeWebp;
            }
        }

        $model->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'descricao' => $this->request->getPost('descricao'),
            'data_inicio' => $this->request->getPost('data_inicio'),
            'data_fim' => $this->request->getPost('data_fim'),
            'hora_inicio' => $this->request->getPost('hora_inicio'),
            'hora_fim' => $this->request->getPost('hora_fim'),
            'local' => $this->request->getPost('local'),
            'cidade' => $this->request->getPost('cidade'),
            'estado' => $this->request->getPost('estado'),
            'ingressos_url' => $this->request->getPost('ingressos_url'),
            'ingressos_texto' => $this->request->getPost('ingressos_texto'),
            'mapa_iframe' => $this->request->getPost('mapa_iframe'),
            'destaque' => $this->request->getPost('destaque') ?? 0,
            'publicado' => $this->request->getPost('publicado') ?? 0,
            'imagem' => $nomeImagem
        ]);

        return redirect()->to('/admin/eventos');
    }

    public function excluir($id)
    {
        $model = new EventoModel();
        $model->delete($id);

        return redirect()->to('/admin/eventos');
    }
}
