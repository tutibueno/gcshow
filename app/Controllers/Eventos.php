<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventoModel;

class Eventos extends BaseController
{
    public function index()
    {
        $model = new EventoModel();

        // Próximos ou em andamento
        $data['proximos_eventos'] = $model
            ->where('data_fim >=', date('Y-m-d'))
            ->where('publicado', 1)
            ->orderBy('data_inicio', 'ASC')
            ->findAll();

        // Eventos anteriores
        $data['eventos_anteriores'] = $model
            ->where('data_fim <', date('Y-m-d'))
            ->where('publicado', 1)
            ->orderBy('data_inicio', 'DESC')
            ->findAll();

        return view('eventos/index', $data);
    }

    public function detalhes($id)
    {
        $model = new EventoModel();
        $data['evento'] = $model->find($id);

        return view('eventos/detalhes', $data);
    }
}