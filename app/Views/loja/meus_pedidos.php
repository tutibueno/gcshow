<?= $this->include('layout/header') ?>

<main class="home-content">
    <section class="content-section">
        <h1 class="section-title">Meus pedidos</h1>
        <?php if ($pedido_sucesso): ?>
            <p class="institutional-intro">Pedido <?= esc($pedido_sucesso) ?> criado com sucesso.</p>
        <?php endif; ?>
    </section>

    <section class="content-section gallery-event-card">
        <form method="post" class="store-filter">
            <input type="email" name="email" class="store-select" placeholder="Digite seu e-mail" value="<?= esc($email) ?>">
            <button type="submit" class="btn btn-primary">Buscar pedidos</button>
        </form>

        <?php if (!empty($pedidos)): ?>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Status</th>
                            <th>Pagamento</th>
                            <th>Total</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td><?= esc($pedido['numero']) ?></td>
                                <td><?= esc($pedido['status']) ?></td>
                                <td><?= esc($pedido['status_pagamento']) ?></td>
                                <td>R$ <?= number_format((float) $pedido['total'], 2, ',', '.') ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($pedido['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif ($email !== ''): ?>
            <p class="institutional-text mt-4">Nenhum pedido encontrado para este e-mail.</p>
        <?php endif; ?>
    </section>
</main>

<?= $this->include('layout/footer') ?>
