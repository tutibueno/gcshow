<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Relatório de vendas</h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form method="get" class="form-inline">
                        <label class="mr-2">Início</label>
                        <input type="date" name="inicio" class="form-control mr-3" value="<?= esc($inicio) ?>">
                        <label class="mr-2">Fim</label>
                        <input type="date" name="fim" class="form-control mr-3" value="<?= esc($fim) ?>">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $resumo['pedidos'] ?></h3>
                            <p>Pedidos no período</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>R$ <?= number_format((float) $resumo['total_vendas'], 2, ',', '.') ?></h3>
                            <p>Total vendido</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Cliente</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidos as $pedido): ?>
                                <tr>
                                    <td><?= esc($pedido['numero']) ?></td>
                                    <td><?= esc($pedido['cliente_nome']) ?></td>
                                    <td><?= esc($pedido['status']) ?></td>
                                    <td>R$ <?= number_format((float) $pedido['total'], 2, ',', '.') ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($pedido['created_at'])) ?></td>
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
