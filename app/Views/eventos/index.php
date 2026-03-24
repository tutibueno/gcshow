<?= $this->include('layout/header') ?>

<div class="home-content">

    <!-- PRÓXIMOS EVENTOS -->
    <section class="content-section">
        <h1 class="section-title">Próximos Eventos</h1>

        <?php if (empty($proximos_eventos)): ?>
            <p>Nenhum evento programado no momento.</p>
        <?php else: ?>

            <div class="news-grid">
                <?php foreach ($proximos_eventos as $evento): ?>
                    <div class="news-card">

                        <?php if ($evento['imagem']): ?>
                            <img src="<?= base_url('uploads/eventos/' . $evento['imagem']) ?>" style="width:100%; border-radius:8px; margin-bottom:10px;">
                        <?php endif; ?>

                        <h3><?= $evento['titulo'] ?></h3>

                        <p>
                            <strong>Data:</strong>
                            <?= date('d/m/Y', strtotime($evento['data_evento'])) ?><br>

                            <strong>Horário:</strong>
                            <?= $evento['hora_inicio'] ?> - <?= $evento['hora_fim'] ?><br>

                            <strong>Local:</strong>
                            <?= $evento['local'] ?> - <?= $evento['cidade'] ?>/<?= $evento['estado'] ?>
                        </p>

                        <?php if ($evento['ingressos_url']): ?>
                            <a href="<?= $evento['ingressos_url'] ?>" target="_blank" class="btn btn-success" style="margin-top:8px;">
                                <?= $evento['ingressos_texto'] ?: 'Comprar ingressos' ?>
                            </a>
                        <?php endif; ?>

                        <a href="<?= base_url('evento/' . $evento['id']) ?>" class="btn btn-primary">
                            Ver detalhes
                        </a>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </section>


    <!-- EVENTOS ANTERIORES -->
    <section class="content-section">
        <h1 class="section-title">Eventos Anteriores</h1>

        <?php if (empty($eventos_anteriores)): ?>
            <p>Nenhum evento anterior cadastrado.</p>
        <?php else: ?>

            <div class="news-grid">
                <?php foreach ($eventos_anteriores as $evento): ?>
                    <div class="news-card">

                        <?php if ($evento['imagem']): ?>
                            <img src="<?= base_url('uploads/eventos/' . $evento['imagem']) ?>" style="width:100%; border-radius:8px; margin-bottom:10px;">
                        <?php endif; ?>

                        <h3><?= $evento['titulo'] ?></h3>

                        <p>
                            <strong>Data:</strong>
                            <?= date('d/m/Y', strtotime($evento['data_evento'])) ?><br>

                            <strong>Local:</strong>
                            <?= $evento['cidade'] ?>/<?= $evento['estado'] ?>
                        </p>

                        <a href="<?= base_url('evento/' . $evento['id']) ?>" class="btn btn-secondary">
                            Ver detalhes
                        </a>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </section>

</div>

<?= $this->include('layout/footer') ?>