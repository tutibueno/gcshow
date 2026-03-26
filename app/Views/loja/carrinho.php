<?= $this->include('layout/header') ?>

<main class="home-content">
    <section class="content-section">
        <h1 class="section-title">Carrinho</h1>
    </section>

    <section class="content-section gallery-event-card">
        <?php if (empty($itens)): ?>
            <p class="institutional-text">Seu carrinho está vazio.</p>
        <?php else: ?>
            <div class="cart-card-list">
                <?php foreach ($itens as $item): ?>
                    <article class="cart-item-card">
                        <div class="cart-item-media">
                            <img src="<?= $item['imagem_capa'] ? base_url('uploads/produtos/' . $item['imagem_capa']) : base_url('public/banner_padrao.jpg') ?>" alt="<?= esc($item['nome']) ?>">
                        </div>

                        <div class="cart-item-body">
                            <div>
                                <h2 class="cart-item-title"><?= esc($item['nome']) ?></h2>
                                <?php if (!empty($item['variacao_nome'])): ?>
                                    <p class="cart-item-variation"><?= esc($item['variacao_nome']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="cart-item-meta">
                                <p>Quantidade: <strong><?= $item['quantidade'] ?></strong></p>
                                <p>Valor unitário: <strong>R$ <?= number_format((float) $item['preco_unitario'], 2, ',', '.') ?></strong></p>
                                <p>Subtotal: <strong>R$ <?= number_format((float) $item['subtotal'], 2, ',', '.') ?></strong></p>
                            </div>
                        </div>

                        <div class="cart-item-actions">
                            <form action="<?= base_url('loja/carrinho/remover') ?>" method="post">
                                <input type="hidden" name="chave" value="<?= esc($item['chave']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm" aria-label="Remover item do carrinho" title="Remover item">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <form action="<?= base_url('loja/carrinho/frete') ?>" method="post" class="store-freight-form">
                <input type="text" name="cep" class="store-select" placeholder="CEP para frete" value="<?= esc($frete_info['cep'] ?? '') ?>">
                <button type="submit" class="btn btn-primary">Calcular frete</button>
            </form>

            <div class="store-summary">
                <p>Subtotal: <strong>R$ <?= number_format((float) $subtotal, 2, ',', '.') ?></strong></p>
                <p>Frete: <strong>R$ <?= number_format((float) $frete, 2, ',', '.') ?></strong></p>
                <p>Total: <strong>R$ <?= number_format((float) $total, 2, ',', '.') ?></strong></p>
                <a href="<?= base_url('loja/checkout') ?>" class="btn btn-success">Ir para checkout</a>
            </div>
        <?php endif; ?>
    </section>
</main>

<?= $this->include('layout/footer') ?>
