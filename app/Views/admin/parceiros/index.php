<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Parceiros</h1>
                <a href="<?= base_url('admin/parceiros/criar') ?>" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i>Novo Parceiro
                </a>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php if (session('success')): ?>
                <div class="alert alert-success"><?= esc(session('success')) ?></div>
            <?php endif; ?>

            <?php if (session('error')): ?>
                <div class="alert alert-danger"><?= esc(session('error')) ?></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Logo</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Ordem</th>
                                <th>Status</th>
                                <th class="text-right" style="width: 260px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($parceiros)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Nenhum parceiro cadastrado.</td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($parceiros as $parceiro): ?>
                                <tr>
                                    <td>
                                        <img src="<?= parceiro_logo_url($parceiro['logo']) ?>" alt="<?= esc($parceiro['nome']) ?>" style="width: 56px; height: 42px; object-fit: contain;">
                                    </td>
                                    <td>
                                        <strong><?= esc($parceiro['nome']) ?></strong>
                                        <?php if (! empty($parceiro['site_url'])): ?>
                                            <br><a href="<?= esc($parceiro['site_url']) ?>" target="_blank" rel="noopener noreferrer"><?= esc($parceiro['site_url']) ?></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?= $parceiro['tipo'] === 'premium' ? 'warning' : 'secondary' ?>">
                                            <?= $parceiro['tipo'] === 'premium' ? 'Premium' : 'Normal' ?>
                                        </span>
                                    </td>
                                    <td><?= (int) $parceiro['ordem'] ?></td>
                                    <td>
                                        <span class="badge badge-<?= $parceiro['ativo'] ? 'success' : 'secondary' ?>">
                                            <?= $parceiro['ativo'] ? 'Ativo' : 'Inativo' ?>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <form action="<?= base_url('admin/parceiros/toggle/' . $parceiro['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                <?= $parceiro['ativo'] ? 'Desativar' : 'Ativar' ?>
                                            </button>
                                        </form>

                                        <a href="<?= base_url('admin/parceiros/editar/' . $parceiro['id']) ?>" class="btn btn-sm btn-warning">Editar</a>

                                        <form action="<?= base_url('admin/parceiros/excluir/' . $parceiro['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este parceiro?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($pager): ?>
                    <div class="card-footer">
                        <?= $pager->links() ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>
