<?= $this->include('layout/header') ?>

<main class="home-content">
    <section class="content-section institutional-card">
        <h1 class="section-title">Newsletter</h1>
        <p class="institutional-text"><?= esc($message) ?></p>
        <a href="<?= base_url('/') ?>" class="btn btn-primary">Voltar para a home</a>
    </section>
</main>

<?= $this->include('layout/footer') ?>
