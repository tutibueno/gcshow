<?= $this->include('layout/header') ?>

<main class="home-content">

    <?php if ($proximo_evento): ?>

        <?php
        $banner = !empty($proximo_evento['imagem'])
            ? base_url('uploads/eventos/' . $proximo_evento['imagem'])
            : base_url('public/banner_padrao.jpg');
        ?>

        <section class="hero" style="background-image: url('<?= $banner ?>');">
            <div class="hero-content">

                <h1><?= $proximo_evento['titulo'] ?></h1>

                <p class="hero-date">
                    <?= periodoResumido($proximo_evento['data_inicio'], $proximo_evento['data_fim']) ?>
                    • <?= $proximo_evento['cidade'] ?>/<?= $proximo_evento['estado'] ?>
                </p>

                <div id="countdown"
                    data-date="<?= $proximo_evento['data_inicio'] ?>"
                    data-time="<?= $proximo_evento['hora_inicio'] ?>">
                </div>

                <div class="hero-buttons">
                    <a href="<?= base_url('evento/' . $proximo_evento['id']) ?>" class="btn btn-primary">
                        Ver evento
                    </a>

                    <?php if ($proximo_evento['ingressos_url']): ?>
                        <a href="<?= $proximo_evento['ingressos_url'] ?>" target="_blank" class="btn btn-success">
                            <?= $proximo_evento['ingressos_texto'] ?: 'Comprar ingressos' ?>
                        </a>
                    <?php endif; ?>
                </div>

            </div>

        </section>

    <?php endif; ?>

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
        <div class="gallery-carousel">
            <?php foreach ($galeria_destaque as $foto): ?>
                <?php if ($foto['tipo'] == 'foto'): ?>
                    <figure class="gallery-slide">
                        <a href="<?= base_url('uploads/galeria/' . $foto['arquivo']) ?>"
                            class="glightbox"
                            data-gallery="home"
                            data-title="<?= esc($foto['titulo'] ?? '') ?>">

                            <img src="<?= base_url('uploads/galeria/' . $foto['arquivo']) ?>">
                        </a>
                    </figure>
                <?php else: ?>
                    <div class="gallery-slide">
                        <a href="<?= $foto['video_url'] ?>"
                            class="glightbox"
                            data-gallery="evento">

                            <img src="https://img.youtube.com/vi/<?= getYouTubeId($foto['video_url']) ?>/hqdefault.jpg">
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- QUEM SOMOS -->
    <section class="content-section" id="quem-somos">
        <h2 class="section-title">Quem somos</h2>
        <p>Texto institucional aqui...</p>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const countdown = document.getElementById("countdown");
        if (!countdown) return;

        const eventDate = countdown.getAttribute("data-date");
        const eventTime = countdown.getAttribute("data-time");

        const targetDate = new Date(eventDate + "T" + eventTime).getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                countdown.innerHTML = "Evento em andamento!";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

            countdown.innerHTML =
                "<div class='countdown-box'>" + days + "<span>dias</span></div>" +
                "<div class='countdown-box'>" + hours + "<span>h</span></div>" +
                "<div class='countdown-box'>" + minutes + "<span>min</span></div>";
        }

        updateCountdown();
        setInterval(updateCountdown, 60000);
    });
</script>

<?= $this->include('layout/footer') ?>