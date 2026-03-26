<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header d-flex justify-content-between align-items-center">
        <h1>Produtos</h1>
        <a href="<?= base_url('admin/produtos/criar') ?>" class="btn btn-primary">Novo produto</a>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Status</th>
                                <th width="180">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos as $produto): ?>
                                <tr>
                                    <td><?= $produto['id'] ?></td>
                                    <td><?= esc($produto['nome']) ?></td>
                                    <td><?= esc($produto['categoria_nome']) ?></td>
                                    <td>R$ <?= number_format((float) ($produto['preco_promocional'] ?: $produto['preco']), 2, ',', '.') ?></td>
                                    <td><?= $produto['estoque'] ?></td>
                                    <td><?= $produto['ativo'] ? 'Ativo' : 'Inativo' ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/produtos/editar/' . $produto['id']) ?>" class="btn btn-sm btn-info">Editar</a>
                                        <a href="<?= base_url('admin/produtos/excluir/' . $produto['id']) ?>" class="btn btn-sm btn-danger">Excluir</a>
                                    </td>
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
