<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Collection Show</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/favicon.ico') ?>">
    <link rel="shortcut icon" href="<?= base_url('public/favicon.ico') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= base_url('public/site.webmanifest') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="<?= base_url('public/css/home.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

</head>

<body>

    <header class="site-header">
        <img class="site-logo" src="<?= base_url('public/logo.png') ?>" alt="Games Collection Show">
        <button class="menu-toggle" id="menuToggle" type="button" aria-expanded="false" aria-controls="siteMenu" aria-label="Abrir menu">
            <span class="menu-toggle-icon" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
        <nav aria-label="Menu principal">
            <?php $uri = service('uri'); ?>

            <ul class="site-menu">
                <li><a class="<?= $uri->getSegment(1) == '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Home</a></li>
                <li><a class="<?= $uri->getSegment(1) == 'eventos' ? 'active' : '' ?>" href="<?= base_url('eventos') ?>">Eventos</a></li>
                <li><a class="<?= $uri->getSegment(1) == 'historia' ? 'active' : '' ?>" href="<?= base_url('historia') ?>">História</a></li>
                <li><a class="<?= $uri->getSegment(1) == 'galeria' ? 'active' : '' ?>" href="<?= base_url('galeria') ?>">Galeria</a></li>
                <li><a class="<?= $uri->getSegment(1) == 'loja' ? 'active' : '' ?>" href="<?= base_url('loja') ?>">Loja</a></li>
            </ul>

        </nav>
    </header>