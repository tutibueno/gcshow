<?= $this->include('layout/header') ?>

<main class="home-content">
    <section class="content-section">
        <div class="gallery-event-header">
            <div>
                <h1 class="section-title">Loja</h1>
                <p class="institutional-intro">Nossos produtos.</p>
            </div>
            <a href="<?= base_url('loja/carrinho') ?>" class="btn btn-success">
                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                Ver carrinho
            </a>
        </div>

        <form method="get" class="store-filter">
            <select name="categoria" class="store-select" onchange="this.form.submit()">
                <option value="">Todas as categorias</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id'] ?>" <?= (string) $categoria_atual === (string) $categoria['id'] ? 'selected' : '' ?>>
                        <?= esc($categoria['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </section>

    <section class="content-section store-grid">
        <?php foreach ($produtos as $produto): ?>
            <article class="product-card store-card">
                <div class="product-images">
                    <img class="product-image" src="<?= $produto['imagem_capa'] ? base_url('uploads/produtos/' . $produto['imagem_capa']) : base_url('public/banner_padrao.jpg') ?>" alt="<?= esc($produto['nome']) ?>">
                </div>
                <div class="product-body">
                    <h2 class="product-title"><?= esc($produto['nome']) ?></h2>
                    <p class="product-description"><?= esc($produto['resumo'] ?: $produto['descricao']) ?></p>
                    <p class="product-price">R$ <?= number_format((float) ($produto['preco_promocional'] ?: $produto['preco']), 2, ',', '.') ?></p>
                    <a href="<?= base_url('loja/produto/' . $produto['slug']) ?>" class="btn btn-primary">Ver detalhes</a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
</main>

<?= $this->include('layout/footer') ?>
