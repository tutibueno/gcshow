<?php

namespace App\Controllers;

use App\Models\EventoModel;

class Home extends BaseController
{
    public function index(): string
    {
        $model = new EventoModel();

        $data['eventos'] = $model
            ->where('data_evento >=', date('Y-m-d'))
            ->where('publicado', 1)
            ->orderBy('data_evento', 'ASC')
            ->limit(3)
            ->find();

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
