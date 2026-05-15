<?php if (! empty($parceirosPremium)): ?>
    <section class="content-section partners-home-section" id="parceiros">
        <div class="section-heading">
            <h2 class="section-title">Parceiros Premium</h2>
            <a href="<?= base_url('parceiros') ?>" class="section-link">Ver todos</a>
        </div>

        <div class="partners-home-grid">
            <?php foreach ($parceirosPremium as $parceiro): ?>
                <?php $siteUrl = trim((string) ($parceiro['site_url'] ?? '')); ?>
                <a class="partner-home-card" href="<?= esc($siteUrl !== '' ? $siteUrl : base_url('parceiros')) ?>" target="<?= $siteUrl !== '' ? '_blank' : '_self' ?>" rel="noopener noreferrer">
                    <img src="<?= parceiro_logo_url($parceiro['logo'] ?? null) ?>" alt="Logo <?= esc($parceiro['nome']) ?>" loading="lazy">
                    <span><?= esc($parceiro['nome']) ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
