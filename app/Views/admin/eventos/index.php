<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Eventos</h1>
                <a href="<?= base_url('admin/eventos/criar') ?>" class="btn btn-primary">Novo Evento</a>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php if (empty($eventos)): ?>
                <div class="card">
                    <div class="card-body text-center text-muted">
                        Nenhum evento cadastrado.
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($eventos as $e): ?>
                        <div class="col-12 d-flex align-items-stretch">
                            <div class="card w-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge badge-secondary">#<?= $e['id'] ?></span>
                                        <?php if ($e['publicado']): ?>
                                            <span class="badge badge-success">Publicado</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Rascunho</span>
                                        <?php endif; ?>
                                    </div>

                                    <h3 class="h5 mb-3"><?= esc($e['titulo']) ?></h3>

                                    <p class="mb-2">
                                        <strong>Data:</strong>
                                        <?php if ($e['data_inicio'] == $e['data_fim']): ?>
                                            <?= date('d/m/Y', strtotime($e['data_inicio'])) ?>
                                        <?php else: ?>
                                            <?= date('d/m/Y', strtotime($e['data_inicio'])) ?> até <?= date('d/m/Y', strtotime($e['data_fim'])) ?>
                                        <?php endif; ?>
                                    </p>

                                    <p class="mb-2"><strong>Horário:</strong> <?= esc($e['hora_inicio']) ?> - <?= esc($e['hora_fim']) ?></p>
                                    <p class="mb-3"><strong>Cidade:</strong> <?= esc($e['cidade']) ?>/<?= esc($e['estado']) ?></p>

                                    <div class="mt-auto">
                                        <p class="text-muted mb-3">
                                            <?php if ((int) $e['total_fotos'] > 0): ?>
                                                <i class="fas fa-camera mr-1"></i><?= (int) $e['total_fotos'] ?> foto(s) cadastrada(s)
                                            <?php else: ?>
                                                <i class="far fa-image mr-1"></i>Sem fotos cadastradas
                                            <?php endif; ?>
                                        </p>
                                        <div class="d-flex flex-wrap">
                                            <a href="<?= base_url('admin/eventos/editar/' . $e['id']) ?>" class="btn btn-warning btn-sm mr-2 mb-2">Editar</a>
                                            <a href="<?= base_url('admin/galeria') ?>" class="btn btn-info btn-sm mr-2 mb-2">Galeria</a>
                                            <a href="<?= base_url('admin/eventos/excluir/' . $e['id']) ?>" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Tem certeza que deseja excluir este evento?');">Excluir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>
