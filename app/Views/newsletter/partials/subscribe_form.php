<section class="content-section newsletter-section">
    <div class="newsletter-card">
        <div>
            <h2 class="section-title">Newsletter</h2>
            <p class="institutional-intro">Receba novidades, próximos eventos e atualizações da loja por e-mail.</p>
        </div>

        <?php if (session('newsletter_success')): ?>
            <p class="newsletter-feedback newsletter-feedback-success"><?= esc(session('newsletter_success')) ?></p>
        <?php endif; ?>

        <?php if (session('newsletter_error')): ?>
            <p class="newsletter-feedback newsletter-feedback-error"><?= esc(session('newsletter_error')) ?></p>
        <?php endif; ?>

        <form action="<?= base_url('newsletter/subscribe') ?>" method="post" class="newsletter-form">
            <input type="text" name="name" class="store-select" placeholder="Seu nome" required>
            <input type="email" name="email" class="store-select" placeholder="Seu e-mail" required>

            <label class="newsletter-consent">
                <input type="checkbox" name="consent_lgpd" value="1" required>
                Autorizo o uso dos meus dados para recebimento da newsletter, conforme a LGPD.
            </label>

            <div class="newsletter-actions">
                <button type="submit" class="btn btn-success">Inscrever-se</button>
                <!-- <a href="<?= base_url('newsletter') ?>" class="btn btn-primary">Abrir página da newsletter</a> -->
            </div>
        </form>
    </div>
</section>
