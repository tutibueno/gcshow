<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Pedido <?= esc($pedido['numero']) ?></h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Cliente</h5>
                            <p>
                                <strong><?= esc($pedido['cliente_nome']) ?></strong><br>
                                <?= esc($pedido['cliente_email']) ?><br>
                                <?= esc($pedido['cliente_telefone']) ?>
                            </p>

                            <h5>Resumo</h5>
                            <p>
                                Status: <?= esc($pedido['status']) ?><br>
                                Pagamento: <?= esc($pedido['status_pagamento']) ?><br>
                                Método: <?= esc($pedido['metodo_pagamento']) ?><br>
                                Total: R$ <?= number_format((float) $pedido['total'], 2, ',', '.') ?>
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('admin/pedidos/atualizar-status/' . $pedido['id']) ?>" method="post">
                                <div class="form-group">
                                    <label>Status do pedido</label>
                                    <select name="status" class="form-control">
                                        <?php foreach (['aguardando_pagamento', 'pago', 'enviado', 'cancelado'] as $status): ?>
                                            <option value="<?= $status ?>" <?= $pedido['status'] === $status ? 'selected' : '' ?>><?= $status ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status do pagamento</label>
                                    <select name="status_pagamento" class="form-control">
                                        <?php foreach (['pendente', 'pago', 'cancelado'] as $statusPagamento): ?>
                                            <option value="<?= $statusPagamento ?>" <?= $pedido['status_pagamento'] === $statusPagamento ? 'selected' : '' ?>><?= $statusPagamento ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Código de rastreio</label>
                                    <input type="text" name="codigo_rastreio" class="form-control" value="<?= esc($pedido['codigo_rastreio']) ?>">
                                </div>
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <textarea name="descricao" class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Atualizar pedido</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Itens</h5>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Qtd</th>
                                        <th>Preço</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($itens as $item): ?>
                                        <tr>
                                            <td><?= esc($item['produto_nome']) ?><br><small><?= esc($item['variacao_nome']) ?></small></td>
                                            <td><?= $item['quantidade'] ?></td>
                                            <td>R$ <?= number_format((float) $item['preco_unitario'], 2, ',', '.') ?></td>
                                            <td>R$ <?= number_format((float) $item['subtotal'], 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5>Histórico</h5>
                            <?php foreach ($historico as $evento): ?>
                                <p class="mb-3">
                                    <strong><?= esc($evento['status']) ?></strong><br>
                                    <?= esc($evento['descricao']) ?><br>
                                    <small><?= date('d/m/Y H:i', strtotime($evento['created_at'])) ?></small>
                                </p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>
