<?= $this->include('layout/header') ?>

<main class="home-content">
    <section class="content-section">
        <h1 class="section-title">Galeria</h1>
        <p class="institutional-intro">Todas as fotos e vídeos dos eventos, organizados do mais recente para o mais antigo.</p>
    </section>

    <?php if (empty($galeria_por_evento)): ?>
        <section class="content-section institutional-card">
            <p class="institutional-text">Nenhum item de galeria foi publicado ainda.</p>
        </section>
    <?php endif; ?>

    <?php foreach ($galeria_por_evento as $evento): ?>
        <section class="content-section gallery-event-card">
            <div class="gallery-event-header">
                <div>
                    <h2 class="section-title"><?= esc($evento['titulo']) ?></h2>
                    <p class="gallery-event-meta">
                        <?= periodoResumido($evento['data_inicio'], $evento['data_fim']) ?>
                        • <?= esc($evento['cidade']) ?>/<?= esc($evento['estado']) ?>
                    </p>
                </div>

                <a href="<?= base_url('evento/' . $evento['id']) ?>" class="btn btn-primary">Ver evento</a>
            </div>

            <?php if (!empty($evento['fotos'])): ?>
                <div class="gallery-block">
                    <h3 class="gallery-block-title">Fotos</h3>
                    <div class="gallery-carousel">
                        <?php foreach ($evento['fotos'] as $foto): ?>
                            <figure class="gallery-slide">
                                <a href="<?= base_url('uploads/galeria/' . $foto['arquivo']) ?>"
                                    class="glightbox"
                                    data-gallery="evento-fotos-<?= $evento['id'] ?>"
                                    data-title="<?= esc($foto['titulo'] ?? '') ?>">
                                    <img src="<?= base_url('uploads/galeria/' . $foto['arquivo']) ?>" alt="<?= esc($foto['titulo'] ?? $evento['titulo']) ?>">
                                </a>
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($evento['videos'])): ?>
                <div class="gallery-block">
                    <h3 class="gallery-block-title">Vídeos</h3>
                    <div class="gallery-carousel">
                        <?php foreach ($evento['videos'] as $video): ?>
                            <div class="gallery-slide">
                                <a href="<?= esc($video['video_url']) ?>"
                                    class="glightbox"
                                    data-gallery="evento-videos-<?= $evento['id'] ?>"
                                    data-title="<?= esc($video['titulo'] ?? '') ?>">
                                    <img src="https://img.youtube.com/vi/<?= getYouTubeId($video['video_url']) ?>/hqdefault.jpg" alt="<?= esc($video['titulo'] ?? $evento['titulo']) ?>">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>
</main>

<?= $this->include('layout/footer') ?>
