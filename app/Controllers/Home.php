<?php

namespace App\Controllers;

use App\Models\EventoModel;
use App\Models\GaleriaModel;
use App\Models\InstitucionalModel;
use App\Models\ParceiroModel;

class Home extends BaseController
{
    public function index()
    {
        $eventoModel = new EventoModel();
        $galeriaModel = new GaleriaModel();
        $institucionalModel = new InstitucionalModel();
        $parceiroModel = new ParceiroModel();

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

        $data['institucional'] = $institucionalModel->first();

        // Cache curto para evitar consultar os parceiros premium em todo acesso à home.
        $cache = service('cache');
        $data['parceirosPremium'] = $cache->get('home_parceiros_premium');
        if ($data['parceirosPremium'] === null) {
            $data['parceirosPremium'] = $parceiroModel->getPremiumParceiros();
            $cache->save('home_parceiros_premium', $data['parceirosPremium'], 300);
        }

        helper('parceiros');

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
