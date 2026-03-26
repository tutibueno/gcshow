<?= $this->include('layout/header') ?>

<?php
$quemSomos = trim($institucional['quem_somos'] ?? '');
$missaoValores = trim($institucional['missao_valores'] ?? '');
$equipeOrganizadora = trim($institucional['equipe_organizadora'] ?? '');
$contatos = trim($institucional['contatos'] ?? '');
$telefoneWhatsapp = trim($institucional['telefone_whatsapp'] ?? '');
$instagramUrl = trim($institucional['instagram_url'] ?? '');
$facebookUrl = trim($institucional['facebook_url'] ?? '');
$youtubeUrl = trim($institucional['youtube_url'] ?? '');
$temCanais = $telefoneWhatsapp !== '' || $instagramUrl !== '' || $facebookUrl !== '' || $youtubeUrl !== '';
?>

<main class="home-content institucional-page">
    <section class="content-section">
        <h1 class="section-title">Sobre</h1>
        <p class="institutional-intro">Conheça a proposta do evento, a equipe organizadora e os canais de contato.</p>
    </section>

    <?php if ($quemSomos !== ''): ?>
        <section class="content-section institutional-card" id="quem-somos">
            <h2 class="section-title">Quem somos</h2>
            <div class="institutional-text"><?= nl2br(esc($quemSomos)) ?></div>
        </section>
    <?php endif; ?>

    <?php if ($missaoValores !== ''): ?>
        <section class="content-section institutional-card" id="missao-valores">
            <h2 class="section-title">Missão e valores</h2>
            <div class="institutional-text"><?= nl2br(esc($missaoValores)) ?></div>
        </section>
    <?php endif; ?>

    <?php if ($equipeOrganizadora !== ''): ?>
        <section class="content-section institutional-card" id="equipe">
            <h2 class="section-title">Equipe organizadora</h2>
            <div class="institutional-text"><?= nl2br(esc($equipeOrganizadora)) ?></div>
        </section>
    <?php endif; ?>

    <?php if ($contatos !== ''): ?>
        <section class="content-section institutional-card" id="contato">
            <h2 class="section-title">Contatos</h2>
            <div class="institutional-text"><?= nl2br(esc($contatos)) ?></div>

            <?php if ($telefoneWhatsapp !== ''): ?>
                <div class="contact-actions">
                    <a
                        href="https://wa.me/<?= preg_replace('/\D+/', '', $telefoneWhatsapp) ?>"
                        class="whatsapp-button"
                        target="_blank"
                        rel="noopener noreferrer">
                        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                        WhatsApp
                    </a>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <?php if ($temCanais): ?>
        <section class="content-section institutional-card" id="redes-sociais">
            <h2 class="section-title">Redes e canais</h2>
            <div class="social-links">
                <?php if ($instagramUrl !== ''): ?>
                    <a href="<?= esc($instagramUrl) ?>" target="_blank" rel="noopener noreferrer" class="social-button social-button-instagram" aria-label="Instagram">
                        <img src="<?= base_url('public/img/Instagram.svg') ?>" alt="" class="social-button-icon" aria-hidden="true">
                    </a>
                <?php endif; ?>
                <?php if ($facebookUrl !== ''): ?>
                    <a href="<?= esc($facebookUrl) ?>" target="_blank" rel="noopener noreferrer" class="social-button social-button-facebook" aria-label="Facebook">
                        <img src="<?= base_url('public/img/Facebook.svg') ?>" alt="" class="social-button-icon" aria-hidden="true">
                    </a>
                <?php endif; ?>
                <?php if ($youtubeUrl !== ''): ?>
                    <a href="<?= esc($youtubeUrl) ?>" target="_blank" rel="noopener noreferrer" class="social-button social-button-youtube" aria-label="YouTube">
                        <img src="<?= base_url('public/img/Youtube.svg') ?>" alt="" class="social-button-icon" aria-hidden="true">
                    </a>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?= $this->include('layout/footer') ?>
