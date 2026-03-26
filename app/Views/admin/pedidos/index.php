<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Pedidos</h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Cliente</th>
                                <th>Status</th>
                                <th>Pagamento</th>
                                <th>Total</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidos as $pedido): ?>
                                <tr>
                                    <td><?= esc($pedido['numero']) ?></td>
                                    <td><?= esc($pedido['cliente_nome']) ?><br><small><?= esc($pedido['cliente_email']) ?></small></td>
                                    <td><?= esc($pedido['status']) ?></td>
                                    <td><?= esc($pedido['status_pagamento']) ?></td>
                                    <td>R$ <?= number_format((float) $pedido['total'], 2, ',', '.') ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($pedido['created_at'])) ?></td>
                                    <td><a href="<?= base_url('admin/pedidos/' . $pedido['id']) ?>" class="btn btn-sm btn-info">Detalhes</a></td>
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
