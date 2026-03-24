<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventoModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $eventoModel = new EventoModel();

        $data = [
            'total_eventos' => $eventoModel->countAll(),
            'proximos_eventos' => $eventoModel
                ->where('data_evento >=', date('Y-m-d'))
                ->countAllResults(),
            'ultimos_eventos' => $eventoModel
                ->orderBy('data_evento', 'DESC')
                ->limit(5)
                ->find()
        ];

        return view('admin/dashboard', $data);
    }
}
