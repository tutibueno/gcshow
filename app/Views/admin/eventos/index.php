<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Eventos</h1>
            <a href="<?= base_url('admin/eventos/criar') ?>" class="btn btn-primary">Novo Evento</a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Cidade</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($eventos as $e): ?>
                                <tr>
                                    <td><?= $e['id'] ?></td>
                                    <td><?= $e['titulo'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($e['data_evento'])) ?></td>
                                    <td><?= $e['hora_inicio'] ?> - <?= $e['hora_fim'] ?></td>
                                    <td><?= $e['cidade'] ?>/<?= $e['estado'] ?></td>
                                    <td>
                                        <?php if ($e['publicado']): ?>
                                            <span class="badge badge-success">Publicado</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Rascunho</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/eventos/editar/' . $e['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="<?= base_url('admin/eventos/excluir/' . $e['id']) ?>" class="btn btn-danger btn-sm">Excluir</a>
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