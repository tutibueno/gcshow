<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Painel Admin</title>

    <link rel="stylesheet" href="<?= base_url('public/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/adminlte/dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?= base_url('admin/sair') ?>" class="nav-link">
                        Sair
                    </a>
                </li>
            </ul>
        </nav>