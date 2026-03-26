<?php

namespace App\Controllers;

use App\Models\InstitucionalModel;

class Institucional extends BaseController
{
    public function index()
    {
        $model = new InstitucionalModel();

        return view('institucional/index', [
            'institucional' => $model->first(),
        ]);
    }
}
