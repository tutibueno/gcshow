<?= $this->include('layout/header') ?>

<main class="home-content partners-page">
    <section class="content-section">
        <div class="section-heading">
            <div>
                <h1 class="section-title">Parceiros</h1>
                <p class="institutional-intro">Empresas e projetos que apoiam o Game Collection Show.</p>
            </div>
        </div>

        <?php if (empty($premium) && empty($normais)): ?>
            <div class="institutional-card">
                <p class="institutional-text mb-0">Nenhum parceiro ativo no momento.</p>
            </div>
        <?php endif; ?>
    </section>

    <?php if (! empty($premium)): ?>
        <section class="content-section">
            <h2 class="section-title">Parceiros Premium</h2>
            <div class="partners-grid partners-grid-premium">
                <?php foreach ($premium as $parceiro): ?>
                    <?= view('frontend/parceiros/_card', ['parceiro' => $parceiro, 'premium' => true]) ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if (! empty($normais)): ?>
        <section class="content-section">
            <h2 class="section-title">Outros Parceiros</h2>
            <div class="partners-grid">
                <?php foreach ($normais as $parceiro): ?>
                    <?= view('frontend/parceiros/_card', ['parceiro' => $parceiro, 'premium' => false]) ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?= $this->include('layout/footer') ?>
