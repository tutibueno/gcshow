<?php

namespace App\Controllers;

use App\Models\EventoModel;
use App\Models\GaleriaModel;

class Home extends BaseController
{
    public function index()
    {
        $eventoModel = new EventoModel();
        $galeriaModel = new GaleriaModel();

        // Próximo evento
        $data['proximo_evento'] = $eventoModel
            ->where('data_inicio >=', date('Y-m-d'))
            ->where('publicado', 1)
            ->orderBy('data_inicio', 'ASC')
            ->first();

        $data['eventos'] = $eventoModel
            ->where('data_inicio >=', date('Y-m-d'))
            ->where('publicado', 1)
            ->orderBy('data_inicio', 'ASC')
            ->limit(10)
            ->find();

        $data['galeria_destaque'] = $galeriaModel
            ->where('destaque', 1)
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->findAll();

        return view('home', $data);
    }

    public function welcome(): string
    {
        return view('welcome_message');
    }

    public function homeold(): string
    {
        return view('home_old');
    }
}
