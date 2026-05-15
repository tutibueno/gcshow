<?= $this->include('layout/header') ?>

<?php
$quemSomos = trim($institucional['quem_somos'] ?? '');
$contatos = trim($institucional['contatos'] ?? '');
$telefoneWhatsapp = trim($institucional['telefone_whatsapp'] ?? '');
$instagramUrl = trim($institucional['instagram_url'] ?? '');
$facebookUrl = trim($institucional['facebook_url'] ?? '');
$youtubeUrl = trim($institucional['youtube_url'] ?? '');
$temRedesSociais = $instagramUrl !== '' || $facebookUrl !== '' || $youtubeUrl !== '';
?>

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

                <div id="countdown" data-date="<?= $proximo_evento['data_inicio'] ?>"
                    data-time="<?= $proximo_evento['hora_inicio'] ?>">
                </div>

                <div class="hero-buttons">
                    <a href="<?= base_url('evento/' . $proximo_evento['id']) ?>" class="btn btn-primary">
                        Ver Evento
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
                        <a href="<?= base_url('uploads/galeria/' . $foto['arquivo']) ?>" class="glightbox" data-gallery="home"
                            data-title="<?= esc($foto['titulo'] ?? '') ?>">

                            <img src="<?= base_url('uploads/galeria/' . $foto['arquivo']) ?>">
                        </a>
                    </figure>
                <?php else: ?>
                    <div class="gallery-slide">
                        <a href="<?= $foto['video_url'] ?>" class="glightbox" data-gallery="evento">

                            <img src="https://img.youtube.com/vi/<?= getYouTubeId($foto['video_url']) ?>/hqdefault.jpg">
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- INSTAGRAM -->
    <section class="content-section" id="instagram">

        <h2 class="section-title">Nosso Instagram</h2>
        <div class="section-heading">

            <behold-widget feed-id="LecPiwmEVfVJMfx5Ik9G"></behold-widget>
            <script>
                (() => {
                    const d = document,
                        s = d.createElement("script");
                    s.type = "module";
                    s.src = "https://w.behold.so/widget.js";
                    d.head.append(s);
                })();
            </script>
        </div>
    </section>

    <!-- QUEM SOMOS -->
    <?php if ($quemSomos !== ''): ?>
        <section class="content-section institutional-card" id="quem-somos">
            <div class="section-heading">
                <h2 class="section-title">Quem somos</h2>
                <a href="<?= base_url('sobre') ?>" class="section-link">Ver página Sobre</a>
            </div>
            <div class="institutional-text"><?= nl2br(esc($quemSomos)) ?></div>
        </section>
    <?php endif; ?>

    <?php if ($contatos !== ''): ?>
        <section class="content-section institutional-card" id="contato">
            <h2 class="section-title">Contato</h2>
            <div class="institutional-text"><?= nl2br(esc($contatos)) ?></div>

            <?php if ($telefoneWhatsapp !== ''): ?>
                <div class="contact-actions">
                    <a href="https://wa.me/<?= preg_replace('/\D+/', '', $telefoneWhatsapp) ?>" class="whatsapp-button"
                        target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                        Falar no WhatsApp
                    </a>
                </div>
            <?php endif; ?>

            <?php if ($temRedesSociais): ?>
                <div class="social-links">
                    <?php if ($instagramUrl !== ''): ?>
                        <a href="<?= esc($instagramUrl) ?>" target="_blank" rel="noopener noreferrer"
                            class="social-button social-button-instagram" aria-label="Instagram">
                            <img src="<?= base_url('public/img/Instagram.svg') ?>" alt="" class="social-button-icon"
                                aria-hidden="true">
                        </a>
                    <?php endif; ?>
                    <?php if ($facebookUrl !== ''): ?>
                        <a href="<?= esc($facebookUrl) ?>" target="_blank" rel="noopener noreferrer"
                            class="social-button social-button-facebook" aria-label="Facebook">
                            <img src="<?= base_url('public/img/Facebook.svg') ?>" alt="" class="social-button-icon"
                                aria-hidden="true">
                        </a>
                    <?php endif; ?>
                    <?php if ($youtubeUrl !== ''): ?>
                        <a href="<?= esc($youtubeUrl) ?>" target="_blank" rel="noopener noreferrer"
                            class="social-button social-button-youtube" aria-label="YouTube">
                            <img src="<?= base_url('public/img/Youtube.svg') ?>" alt="" class="social-button-icon"
                                aria-hidden="true">
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <?= view('newsletter/partials/subscribe_form') ?>

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