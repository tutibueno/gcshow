<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Newsletter</h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form method="get" action="<?= base_url('admin/newsletter') ?>" class="form-inline">
                        <input type="text" name="q" class="form-control mr-2" placeholder="Buscar por nome ou email" value="<?= esc($term) ?>">
                        <button type="submit" class="btn btn-primary mr-2">Buscar</button>
                        <a href="<?= base_url('admin/newsletter/export?q=' . urlencode($term)) ?>" class="btn btn-success">Exportar CSV</a>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Criado em</th>
                                <th width="320">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subscribers as $subscriber): ?>
                                <tr>
                                    <td><?= $subscriber['id'] ?></td>
                                    <td><?= esc($subscriber['name']) ?></td>
                                    <td><?= esc($subscriber['email']) ?></td>
                                    <td><?= esc($subscriber['status']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($subscriber['created_at'])) ?></td>
                                    <td>
                                        <form action="<?= base_url('admin/newsletter/status/' . $subscriber['id']) ?>" method="post" class="form-inline">
                                            <select name="status" class="form-control form-control-sm mr-2">
                                                <option value="active" <?= $subscriber['status'] === 'active' ? 'selected' : '' ?>>Ativo</option>
                                                <option value="unsubscribed" <?= $subscriber['status'] === 'unsubscribed' ? 'selected' : '' ?>>Cancelado</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-info mr-2">Salvar</button>
                                            <a href="<?= base_url('admin/newsletter/delete/' . $subscriber['id']) ?>" class="btn btn-sm btn-danger">Excluir</a>
                                        </form>
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
