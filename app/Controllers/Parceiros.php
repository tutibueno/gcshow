<?php

namespace App\Controllers;

use App\Models\ParceiroModel;

class Parceiros extends BaseController
{
    public function index()
    {
        helper('parceiros');

        $parceiros = (new ParceiroModel())->getAllActiveParceiros();

        return view('frontend/parceiros/index', [
            'premium' => array_values(array_filter($parceiros, static fn ($item) => $item['tipo'] === 'premium')),
            'normais' => array_values(array_filter($parceiros, static fn ($item) => $item['tipo'] === 'normal')),
        ]);
    }
}
