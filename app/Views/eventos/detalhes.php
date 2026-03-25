<?= $this->include('layout/header') ?>

<div class="home-content">

    <h1 class="section-title"><?= $evento['titulo'] ?></h1>

    <?php if ($evento['imagem']): ?>
        <img src="<?= base_url('uploads/eventos/' . $evento['imagem']) ?>" style="width:100%; max-width:600px; border-radius:10px;">
    <?php endif; ?>

    <p>
        <strong>Data:</strong><br>

        <?php
        $dias = diasEvento($evento['data_inicio'], $evento['data_fim']);
        foreach ($dias as $dia):
        ?>
            <?= $dia ?><br>
        <?php endforeach; ?>

        <strong>Horário:</strong>
        <?= horaEvento($evento['hora_inicio'], $evento['hora_fim']) ?>
    </p>



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

    <?php if ($evento['mapa_iframe']): ?>
        <h3>Local do evento</h3>
        <div style="max-width:100%; overflow:hidden; border-radius:10px;">
            <?= $evento['mapa_iframe'] ?>
        </div>
    <?php endif; ?>

    <h3>Galeria</h3>

    <div class="gallery-carousel">

        <?php foreach ($galeria as $item): ?>

            <?php if ($item['tipo'] == 'foto'): ?>
                <figure class="gallery-slide">
                    <a href="<?= base_url('uploads/galeria/' . $item['arquivo']) ?>"
                        class="glightbox"
                        data-gallery="evento"
                        data-title="<?= esc($item['titulo']) ?>">

                        <img src="<?= base_url('uploads/galeria/' . $item['arquivo']) ?>">
                    </a>
                </figure>
            <?php else: ?>
                <div class="gallery-slide">
                    <a href="<?= $item['video_url'] ?>"
                        class="glightbox"
                        data-gallery="evento">

                        <img src="https://img.youtube.com/vi/<?= getYouTubeId($item['video_url']) ?>/hqdefault.jpg">
                    </a>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>

    </div>

</div>


<?= $this->include('layout/footer') ?>