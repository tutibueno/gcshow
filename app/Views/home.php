<?= $this->include('layout/header') ?>

<main class="home-content">

    <!-- QUEM SOMOS -->
    <section class="content-section" id="quem-somos">
        <h2 class="section-title">Quem somos</h2>
        <p>Texto institucional aqui...</p>
    </section>

    <!-- EVENTOS -->
    <section class="content-section" id="eventos">
        <h2 class="section-title">Próximos eventos</h2>

        <div class="news-grid">
            <?php foreach ($eventos as $evento): ?>
                <div class="news-card">
                    <h3><?= $evento['titulo'] ?></h3>
                    <p>
                        <strong>Data:</strong>
                        <?= periodoResumido($evento['data_inicio'], $evento['data_fim']) ?><br>

                        <strong>Horário:</strong>
                        <?= horaEvento($evento['hora_inicio'], $evento['hora_fim']) ?><br>

                        <strong>Local:</strong>
                        <?= $evento['cidade'] ?>/<?= $evento['estado'] ?>
                    </p>

                    <a href="<?= base_url('evento/' . $evento['id']) ?>">
                        Ver detalhes
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <br>
        <a href="<?= base_url('eventos') ?>" class="btn btn-primary">
            Ver todos os eventos
        </a>
    </section>

    <!-- GALERIA -->
    <section class="content-section" id="galeria">
        <h2 class="section-title">Destaques</h2>
        <!-- seu carousel atual -->
    </section>

    <!-- CONTATO -->
    <section class="content-section" id="contato">
        <h2 class="section-title">Contato</h2>
        <p class="contact-text">Fale conosco.</p>
        <a
            href="https://wa.me/5511981824614"
            class="whatsapp-button"
            target="_blank"
            rel="noopener noreferrer">
            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
            Wilmers Eventos
        </a>
    </section>

</main>

<?= $this->include('layout/footer') ?>