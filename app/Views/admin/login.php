<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link rel="stylesheet" href="<?= base_url('public/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/adminlte/dist/css/adminlte.min.css') ?>">
    <style>
        .login-box {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
            padding: 0 16px;
        }

        .login-logo {
            text-align: center;
        }
    </style>
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <b>Painel</b> Admin
        </div>

        <div class="card">
            <div class="card-body login-card-body">

                <?php if (session()->getFlashdata('erro')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('erro') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/admin/login/autenticar') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="senha" class="form-control" placeholder="Senha">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Entrar
                    </button>
                </form>

            </div>
        </div>
    </div>

</body>

</html>
