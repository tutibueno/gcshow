<?= $this->include('layout/header') ?>

<main class="home-content">
    <section class="content-section gallery-event-card">
        <div class="gallery-event-header">
            <div>
                <h1 class="section-title"><?= esc($produto['nome']) ?></h1>
                <p class="gallery-event-meta"><?= esc($produto['resumo']) ?></p>
            </div>
            <a href="<?= base_url('loja/carrinho') ?>" class="btn btn-success">
                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                Carrinho
            </a>
        </div>

        <div class="store-detail-grid">
            <div>
                <div class="gallery-carousel product-gallery-carousel">
                    <?php foreach ($imagens as $imagem): ?>
                        <figure class="gallery-slide">
                            <a href="<?= base_url('uploads/produtos/' . $imagem['arquivo']) ?>" class="glightbox" data-gallery="produto">
                                <img src="<?= base_url('uploads/produtos/' . $imagem['arquivo']) ?>" alt="<?= esc($produto['nome']) ?>">
                            </a>
                        </figure>
                    <?php endforeach; ?>
                </div>
            </div>
            <div>
                <p class="product-price">R$ <?= number_format((float) ($produto['preco_promocional'] ?: $produto['preco']), 2, ',', '.') ?></p>
                <p class="institutional-text"><?= nl2br(esc($produto['descricao'])) ?></p>

                <form action="<?= base_url('loja/carrinho/adicionar') ?>" method="post" class="store-buy-box">
                    <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">

                    <?php if (!empty($variacoes)): ?>
                        <div class="form-group">
                            <label>Variação</label>
                            <select name="variacao_id" class="store-select">
                                <?php foreach ($variacoes as $variacao): ?>
                                    <option value="<?= $variacao['id'] ?>">
                                        <?= esc($variacao['nome']) ?><?= $variacao['tamanho'] ? ' / ' . esc($variacao['tamanho']) : '' ?><?= $variacao['cor'] ? ' / ' . esc($variacao['cor']) : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Quantidade</label>
                        <input type="number" name="quantidade" class="store-select" value="1" min="1">
                    </div>

                    <button type="submit" class="btn btn-success">Adicionar ao carrinho</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?= $this->include('layout/footer') ?>
