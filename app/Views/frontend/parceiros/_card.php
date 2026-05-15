<?php
$descricao = trim((string) ($parceiro['descricao'] ?? ''));
$siteUrl = trim((string) ($parceiro['site_url'] ?? ''));
?>

<article class="partner-card <?= ! empty($premium) ? 'partner-card-premium' : '' ?>">
    <div class="partner-logo-wrap">
        <img src="<?= parceiro_logo_url($parceiro['logo'] ?? null) ?>" alt="Logo <?= esc($parceiro['nome']) ?>" class="partner-logo" loading="lazy">
    </div>

    <div class="partner-card-body">
        <h3><?= esc($parceiro['nome']) ?></h3>

        <?php if ($descricao !== ''): ?>
            <p><?= esc(mb_strimwidth($descricao, 0, 150, '...')) ?></p>
        <?php endif; ?>

        <?php if ($siteUrl !== ''): ?>
            <a href="<?= esc($siteUrl) ?>" target="_blank" rel="noopener noreferrer" class="partner-link">
                Visitar site
            </a>
        <?php endif; ?>
    </div>
</article>
