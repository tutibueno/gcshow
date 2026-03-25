<?php

function dataEvento($data)
{
    $diasSemana = [
        'Sun' => 'Dom',
        'Mon' => 'Seg',
        'Tue' => 'Ter',
        'Wed' => 'Qua',
        'Thu' => 'Qui',
        'Fri' => 'Sex',
        'Sat' => 'Sáb'
    ];

    $meses = [
        1 => 'jan',
        2 => 'fev',
        3 => 'mar',
        4 => 'abr',
        5 => 'mai',
        6 => 'jun',
        7 => 'jul',
        8 => 'ago',
        9 => 'set',
        10 => 'out',
        11 => 'nov',
        12 => 'dez'
    ];

    $timestamp = strtotime($data);

    $diaSemana = $diasSemana[date('D', $timestamp)];
    $dia = date('j', $timestamp);
    $mes = $meses[(int)date('n', $timestamp)];
    $ano = date('Y', $timestamp);

    return "{$diaSemana}, {$dia} de {$mes} de {$ano}";
}

function horaEvento($horaInicio, $horaFim)
{
    $inicio = date('H\h', strtotime($horaInicio));
    $fim = date('H\h', strtotime($horaFim));

    return "{$inicio} às {$fim}";
}

function diasEvento($dataInicio, $dataFim)
{
    $diasSemana = [
        'Sun' => 'Dom',
        'Mon' => 'Seg',
        'Tue' => 'Ter',
        'Wed' => 'Qua',
        'Thu' => 'Qui',
        'Fri' => 'Sex',
        'Sat' => 'Sáb'
    ];

    $meses = [
        1 => 'jan',
        2 => 'fev',
        3 => 'mar',
        4 => 'abr',
        5 => 'mai',
        6 => 'jun',
        7 => 'jul',
        8 => 'ago',
        9 => 'set',
        10 => 'out',
        11 => 'nov',
        12 => 'dez'
    ];

    $inicio = new DateTime($dataInicio);
    $fim = new DateTime($dataFim);
    $fim->modify('+1 day');

    $periodo = new DatePeriod($inicio, new DateInterval('P1D'), $fim);

    $datas = [];

    foreach ($periodo as $data) {
        $diaSemana = $diasSemana[$data->format('D')];
        $dia = $data->format('j');
        $mes = $meses[(int)$data->format('n')];
        $ano = $data->format('Y');

        $datas[] = "{$diaSemana}, {$dia} de {$mes} de {$ano}";
    }

    return $datas;
}

function periodoResumido($dataInicio, $dataFim)
{
    $meses = [
        1 => 'jan',
        2 => 'fev',
        3 => 'mar',
        4 => 'abr',
        5 => 'mai',
        6 => 'jun',
        7 => 'jul',
        8 => 'ago',
        9 => 'set',
        10 => 'out',
        11 => 'nov',
        12 => 'dez'
    ];

    $inicio = new DateTime($dataInicio);
    $fim = new DateTime($dataFim);

    $diaInicio = $inicio->format('j');
    $diaFim = $fim->format('j');

    $mesInicio = $meses[(int)$inicio->format('n')];
    $mesFim = $meses[(int)$fim->format('n')];

    $anoInicio = $inicio->format('Y');
    $anoFim = $fim->format('Y');

    // Mesmo dia
    if ($dataInicio == $dataFim) {
        return "{$diaInicio} de {$mesInicio} de {$anoInicio}";
    }

    // Mesmo mês e ano
    if ($mesInicio == $mesFim && $anoInicio == $anoFim) {
        if ($diaFim == $diaInicio + 1) {
            return "{$diaInicio} e {$diaFim} de {$mesInicio} de {$anoInicio}";
        } else {
            return "{$diaInicio} a {$diaFim} de {$mesInicio} de {$anoInicio}";
        }
    }

    // Meses diferentes mesmo ano
    if ($anoInicio == $anoFim) {
        return "{$diaInicio} de {$mesInicio} a {$diaFim} de {$mesFim} de {$anoInicio}";
    }

    // Anos diferentes
    return "{$diaInicio} de {$mesInicio} de {$anoInicio} a {$diaFim} de {$mesFim} de {$anoFim}";
}
