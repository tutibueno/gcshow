<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Dashboard</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <!-- Total Eventos -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_eventos ?></h3>
                            <p>Total de Eventos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                </div>

                <!-- Próximos Eventos -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $proximos_eventos ?></h3>
                            <p>Próximos Eventos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Últimos eventos -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Últimos eventos cadastrados</h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Data</th>
                                <th>Local</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ultimos_eventos as $evento): ?>
                                <tr>
                                    <td><?= $evento['titulo'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($evento['data_evento'])) ?></td>
                                    <td><?= $evento['local'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

</div>

<?= $this->include('admin/layout/footer') ?>