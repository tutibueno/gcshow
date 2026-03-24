<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventoModel;

class Eventos extends BaseController
{
    public function index()
    {
        $model = new EventoModel();

        $data['proximos_eventos'] = $model
            ->where('data_evento >=', date('Y-m-d'))
            ->where('publicado', 1)
            ->orderBy('data_evento', 'ASC')
            ->findAll();

        $data['eventos_anteriores'] = $model
            ->where('data_evento <', date('Y-m-d'))
            ->where('publicado', 1)
            ->orderBy('data_evento', 'DESC')
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
