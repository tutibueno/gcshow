<?= $this->include('layout/header') ?>

<div class="home-content">

    <h1 class="section-title"><?= $evento['titulo'] ?></h1>

    <?php if ($evento['imagem']): ?>
        <img src="<?= base_url('uploads/eventos/' . $evento['imagem']) ?>" style="width:100%; max-width:600px; border-radius:10px;">
    <?php endif; ?>

    <p>
        <strong>Data:</strong> <?= date('d/m/Y', strtotime($evento['data_evento'])) ?><br>
        <strong>Horário:</strong> <?= $evento['hora_inicio'] ?> - <?= $evento['hora_fim'] ?><br>
        <strong>Local:</strong> <?= $evento['local'] ?><br>
        <strong>Cidade:</strong> <?= $evento['cidade'] ?>/<?= $evento['estado'] ?>
    </p>

    <p><?= nl2br($evento['descricao']) ?></p>

    <?php if ($evento['ingressos_url']): ?>
        <p>
            <a href="<?= $evento['ingressos_url'] ?>" target="_blank" class="btn btn-success">
                <?= $evento['ingressos_texto'] ?: 'Comprar ingressos' ?>
            </a>
        </p>
    <?php endif; ?>

</div>

<?= $this->include('layout/footer') ?>