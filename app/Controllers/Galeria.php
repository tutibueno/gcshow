<?php

namespace App\Controllers;

use App\Models\GaleriaModel;

class Galeria extends BaseController
{
    public function index()
    {
        $model = new GaleriaModel();

        $itens = $model
            ->select('
                galeria.*,
                eventos.id as evento_publico_id,
                eventos.titulo as evento_titulo,
                eventos.data_inicio,
                eventos.data_fim,
                eventos.cidade,
                eventos.estado
            ')
            ->join('eventos', 'eventos.id = galeria.evento_id')
            ->where('eventos.publicado', 1)
            ->orderBy('eventos.data_inicio', 'DESC')
            ->orderBy('galeria.id', 'DESC')
            ->findAll();

        $eventosAgrupados = [];

        foreach ($itens as $item) {
            $eventoId = $item['evento_publico_id'];

            if (!isset($eventosAgrupados[$eventoId])) {
                $eventosAgrupados[$eventoId] = [
                    'id' => $eventoId,
                    'titulo' => $item['evento_titulo'],
                    'data_inicio' => $item['data_inicio'],
                    'data_fim' => $item['data_fim'],
                    'cidade' => $item['cidade'],
                    'estado' => $item['estado'],
                    'fotos' => [],
                    'videos' => [],
                ];
            }

            if ($item['tipo'] === 'foto') {
                $eventosAgrupados[$eventoId]['fotos'][] = $item;
                continue;
            }

            $eventosAgrupados[$eventoId]['videos'][] = $item;
        }

        return view('galeria/index', [
            'galeria_por_evento' => array_values($eventosAgrupados),
        ]);
    }
}
