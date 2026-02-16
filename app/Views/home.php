<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Collection Show</title>
    <?php $assetPrefix = is_file(FCPATH . 'public/favicon.ico') ? 'public/' : ''; ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url($assetPrefix . 'apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url($assetPrefix . 'favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url($assetPrefix . 'favicon-16x16.png') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url($assetPrefix . 'favicon.ico') ?>">
    <link rel="shortcut icon" href="<?= base_url($assetPrefix . 'favicon.ico') ?>">
    <link rel="manifest" href="<?= base_url($assetPrefix . 'site.webmanifest') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="<?= base_url($assetPrefix . 'css/home.css') ?>">
</head>

<body>
    <header class="site-header">
        <img class="site-logo" src="<?= base_url($assetPrefix . 'logo.png') ?>" alt="Games Collection Show">
        <button class="menu-toggle" id="menuToggle" type="button" aria-expanded="false" aria-controls="siteMenu" aria-label="Abrir menu">
            <span class="menu-toggle-icon" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
        <nav aria-label="Menu principal">
            <ul class="site-menu" id="siteMenu">
                <li><a href="#noticias">Notícias</a></li>
                <li><a href="#agenda">Agenda</a></li>
                <li><a href="#galeria">Galeria</a></li>
                <li><a href="#produtos">Vendas</a></li>
            </ul>
        </nav>
    </header>

    <main class="home-content">
        <section class="content-section" id="noticias">
            <h2 class="section-title">Últimas Notícias</h2>
            <div class="news-grid">
                <article class="news-card">
                    <h3>Novo RPG de mundo aberto ganha data de lançamento</h3>
                    <p>O estúdio Silver Forge confirmou o lançamento para julho, com foco em exploração, escolhas narrativas e modo cooperativo para até quatro jogadores.</p>
                </article>
                <article class="news-card">
                    <h3>Atualização competitiva melhora desempenho em consoles</h3>
                    <p>O patch 2.3 de Battle Arena Legends trouxe otimizações gráficas, reduziu tempo de carregamento e ajustou balanceamento de personagens no modo ranqueado.</p>
                </article>
            </div>
        </section>

        <section class="content-section" id="agenda">
            <h2 class="section-title">Agenda</h2>
            <p>Conteúdo temporário: em breve publicaremos o calendário oficial com datas de exposições, encontros de colecionadores e lançamentos especiais.</p>
            <p>Próximos destaques (prévia):</p>
            <ul>
                <li>Março: Game Collection Show - Jabaquara</li>
                <li>Abril: Game Collection Show - Jabaquara</li>
                <li>Maio: Super Game Collection Show - Liberdade</li>
                <li>Junho: Evento Canal 3 - São Paulo</li>
            </ul>
        </section>

        <section class="content-section" id="galeria">
            <h2 class="section-title">Galeria de Fotos</h2>
            <?php
            $galleryDir   = FCPATH . $assetPrefix . 'uploads/galeria/';
            $galleryFiles = [];

            if (is_dir($galleryDir)) {
                $galleryFiles = glob($galleryDir . '*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [];
                $galleryFiles = array_map('basename', $galleryFiles);
                sort($galleryFiles, SORT_NATURAL | SORT_FLAG_CASE);
            }
            ?>

            <?php if ($galleryFiles === []): ?>
                <p>Sem fotos no momento.</p>
            <?php else: ?>
                <div class="gallery-carousel" aria-label="Carrossel de fotos da galeria">
                    <?php foreach ($galleryFiles as $index => $imageName): ?>
                        <figure class="gallery-slide">
                            <img
                                src="<?= esc(base_url($assetPrefix . 'uploads/galeria/' . rawurlencode($imageName))) ?>"
                                alt="Foto da galeria <?= $index + 1 ?>"
                                loading="lazy">
                        </figure>
                    <?php endforeach; ?>
                </div>
                <p class="gallery-hint">Arraste para o lado para ver mais fotos.</p>
            <?php endif; ?>
        </section>

        <section class="content-section" id="produtos">
            <h2 class="section-title">Vendas de Produtos</h2>
            <div class="products-carousel" id="productsCarousel" aria-label="Carrossel de produtos"></div>
            <p class="products-feedback" id="productsFeedback">Carregando produtos...</p>
            <p class="gallery-hint">Arraste para o lado para ver mais produtos.</p>
        </section>
    </main>

    <footer class="site-footer">
        &copy; <?= date('Y') ?> <strong>Game Collection Show</strong>
        <p>
            <a href="https://www.instagram.com/wilmerseventos/" target="_blank" style="color: #ccc; text-decoration: underline;">Instagram Wilmers Eventos</a> |
            <a href="https://www.facebook.com/profile.php?id=61557788171224" target="_blank" style="color: #ccc; text-decoration: underline;">Facebook</a> |
            <a href="https://www.instagram.com/gamecollectionshow/" target="_blank" style="color: #ccc; text-decoration: underline;">Instagram</a>
        </p>
    </footer>

    <script>
        (function() {
            const productsUrl = '<?= base_url($assetPrefix . 'produtos.json') ?>';
            const siteBaseUrl = '<?= base_url() ?>';
            const uploadsBaseUrl = '<?= base_url($assetPrefix . 'uploads/') ?>';
            const carouselEl = document.getElementById('productsCarousel');
            const feedbackEl = document.getElementById('productsFeedback');
            const menuToggleEl = document.getElementById('menuToggle');
            const siteMenuEl = document.getElementById('siteMenu');

            if (menuToggleEl && siteMenuEl) {
                menuToggleEl.addEventListener('click', () => {
                    const isOpen = siteMenuEl.classList.toggle('is-open');
                    menuToggleEl.classList.toggle('is-active', isOpen);
                    menuToggleEl.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });

                siteMenuEl.querySelectorAll('a').forEach((linkEl) => {
                    linkEl.addEventListener('click', () => {
                        siteMenuEl.classList.remove('is-open');
                        menuToggleEl.classList.remove('is-active');
                        menuToggleEl.setAttribute('aria-expanded', 'false');
                    });
                });

                window.addEventListener('resize', () => {
                    if (window.innerWidth > 768) {
                        siteMenuEl.classList.remove('is-open');
                        menuToggleEl.classList.remove('is-active');
                        menuToggleEl.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            function asArray(payload) {
                if (Array.isArray(payload)) {
                    return payload;
                }

                if (payload && Array.isArray(payload.data)) {
                    return payload.data;
                }

                if (payload && Array.isArray(payload.produtos)) {
                    return payload.produtos;
                }

                return [];
            }

            function pick(product, keys) {
                for (const key of keys) {
                    if (product[key] !== undefined && product[key] !== null && product[key] !== '') {
                        return product[key];
                    }
                }
                return '';
            }

            function toImageUrl(value, fromUploads = false) {
                if (!value) {
                    return '';
                }

                const raw = String(value).trim();

                if (/^https?:\/\//i.test(raw)) {
                    return raw;
                }

                try {
                    if (raw.includes('uploads/')) {
                        return new URL(raw.replace(/^public\//, ''), siteBaseUrl).href;
                    }

                    if (fromUploads) {
                        return new URL(raw, uploadsBaseUrl).href;
                    }

                    return new URL(raw, siteBaseUrl).href;
                } catch (error) {
                    return '';
                }
            }

            function formatPrice(value) {
                if (value === '' || value === null || value === undefined) {
                    return '';
                }

                const numeric = Number(String(value).replace(',', '.'));

                if (!Number.isNaN(numeric)) {
                    return numeric.toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    });
                }

                return String(value);
            }

            function toNumber(value) {
                if (value === '' || value === null || value === undefined) {
                    return NaN;
                }
                return Number(String(value).replace(',', '.'));
            }

            function getPriceData(product) {
                const originalValue = pick(product, ['preco', 'valor', 'price']);
                const discountValue = pick(product, ['desconto', 'discount']);

                const originalNumber = toNumber(originalValue);
                const discountNumber = toNumber(discountValue);

                if (Number.isNaN(originalNumber)) {
                    return {
                        originalText: '',
                        finalText: '',
                        hasDiscount: false,
                    };
                }

                const hasDiscount = !Number.isNaN(discountNumber) && discountNumber > 0;
                const discountPercent = hasDiscount ? Math.min(discountNumber, 100) : 0;
                const finalNumber = hasDiscount ? originalNumber * (1 - discountPercent / 100) : originalNumber;

                return {
                    originalText: formatPrice(originalNumber),
                    finalText: formatPrice(finalNumber),
                    hasDiscount,
                };
            }

            function isRecentlyCreated(product, days = 30) {
                const createdAtRaw = pick(product, ['created_at', 'createdAt', 'data_cadastro']);
                if (!createdAtRaw) {
                    return false;
                }

                const normalized = String(createdAtRaw).replace(' ', 'T');
                const createdAt = new Date(normalized);
                if (Number.isNaN(createdAt.getTime())) {
                    return false;
                }

                const diffMs = Date.now() - createdAt.getTime();
                return diffMs >= 0 && diffMs <= days * 24 * 60 * 60 * 1000;
            }

            function formatDiscountBadge(value) {
                if (value === '' || value === null || value === undefined) {
                    return '';
                }

                const numeric = Number(String(value).replace(',', '.'));
                if (Number.isNaN(numeric) || numeric <= 0) {
                    return '';
                }

                const numberText = Number.isInteger(numeric) ? String(numeric) : numeric.toFixed(2).replace('.', ',');
                return `${numberText}% OFF!`;
            }

            function collectProductImages(product) {
                const imageUrls = [];

                if (product && Array.isArray(product.imagens)) {
                    product.imagens
                        .slice()
                        .sort((a, b) => Number(a.ordem ?? 0) - Number(b.ordem ?? 0))
                        .forEach((imageItem) => {
                            const uri = imageItem && imageItem.uri ? String(imageItem.uri).trim() : '';
                            const fromFile = imageItem && imageItem.imagem ? toImageUrl(imageItem.imagem, true) : '';
                            const finalUrl = uri || fromFile;

                            if (finalUrl && !imageUrls.includes(finalUrl)) {
                                imageUrls.push(finalUrl);
                            }
                        });
                }

                const fallbackSingle = toImageUrl(pick(product, ['imagem', 'foto', 'image', 'thumbnail']));
                if (fallbackSingle && !imageUrls.includes(fallbackSingle)) {
                    imageUrls.push(fallbackSingle);
                }

                return imageUrls;
            }

            function createCard(product, index) {
                const title = pick(product, ['nome', 'titulo', 'title', 'name']) || `Produto ${index + 1}`;
                const productId = pick(product, ['id', 'produto_id']);
                const status = String(pick(product, ['status'])).toLowerCase();
                const isNew = isRecentlyCreated(product);
                const discountBadgeText = formatDiscountBadge(pick(product, ['desconto', 'discount']));
                const description = pick(product, ['descricao', 'description']);
                const priceData = getPriceData(product);
                const imageUrls = collectProductImages(product);

                const cardEl = document.createElement('article');
                cardEl.className = 'product-card';

                const badgesEl = document.createElement('div');
                badgesEl.className = 'product-badges';

                if (status === 'vendido') {
                    const soldBadgeEl = document.createElement('span');
                    soldBadgeEl.className = 'product-badge-sold';
                    soldBadgeEl.textContent = 'VENDIDO';
                    badgesEl.appendChild(soldBadgeEl);
                }

                if (isNew) {
                    const newBadgeEl = document.createElement('span');
                    newBadgeEl.className = 'product-badge-new';
                    newBadgeEl.textContent = 'NOVO!';
                    badgesEl.appendChild(newBadgeEl);
                }

                if (discountBadgeText) {
                    const discountBadgeEl = document.createElement('span');
                    discountBadgeEl.className = 'product-badge-discount';
                    discountBadgeEl.textContent = discountBadgeText;
                    badgesEl.appendChild(discountBadgeEl);
                }

                if (badgesEl.childElementCount > 0) {
                    cardEl.appendChild(badgesEl);
                }

                if (imageUrls.length > 0) {
                    const imagesWrapEl = document.createElement('div');
                    imagesWrapEl.className = 'product-images';

                    const imagesTrackEl = document.createElement('div');
                    imagesTrackEl.className = 'product-images-track';

                    imageUrls.forEach((url, imageIndex) => {
                        const imageEl = document.createElement('img');
                        imageEl.className = 'product-image';
                        imageEl.src = url;
                        imageEl.alt = `${title} - imagem ${imageIndex + 1}`;
                        imageEl.loading = 'lazy';
                        imagesTrackEl.appendChild(imageEl);
                    });

                    imagesWrapEl.appendChild(imagesTrackEl);
                    cardEl.appendChild(imagesWrapEl);
                }

                const bodyEl = document.createElement('div');
                bodyEl.className = 'product-body';

                const titleEl = document.createElement('h3');
                titleEl.className = 'product-title';
                titleEl.textContent = title;
                bodyEl.appendChild(titleEl);

                if (description) {
                    const descEl = document.createElement('p');
                    descEl.className = 'product-description';
                    descEl.textContent = description;
                    bodyEl.appendChild(descEl);
                }

                if (priceData.finalText) {
                    if (priceData.hasDiscount) {
                        const originalPriceEl = document.createElement('p');
                        originalPriceEl.className = 'product-price-original';
                        originalPriceEl.textContent = priceData.originalText;
                        bodyEl.appendChild(originalPriceEl);

                        const finalPriceEl = document.createElement('p');
                        finalPriceEl.className = 'product-price';
                        finalPriceEl.textContent = priceData.finalText;
                        bodyEl.appendChild(finalPriceEl);
                    } else {
                        const priceEl = document.createElement('p');
                        priceEl.className = 'product-price';
                        priceEl.textContent = priceData.finalText;
                        bodyEl.appendChild(priceEl);
                    }
                }

                const whatsappMessage = `Olá! Tenho interesse no produto ${title} id${productId}`;
                const whatsappUrl = `https://api.whatsapp.com/send?phone=551199602001&text=${encodeURIComponent(whatsappMessage)}`;

                const whatsappLinkEl = document.createElement('a');
                whatsappLinkEl.className = 'product-whatsapp';
                whatsappLinkEl.href = whatsappUrl;
                whatsappLinkEl.target = '_blank';
                whatsappLinkEl.rel = 'noopener noreferrer';
                const whatsappIconEl = document.createElement('i');
                whatsappIconEl.className = 'fa-brands fa-whatsapp';
                whatsappIconEl.setAttribute('aria-hidden', 'true');

                const whatsappTextEl = document.createElement('span');
                whatsappTextEl.textContent = 'Falar com o Vendedor';

                whatsappLinkEl.appendChild(whatsappIconEl);
                whatsappLinkEl.appendChild(whatsappTextEl);
                bodyEl.appendChild(whatsappLinkEl);

                cardEl.appendChild(bodyEl);

                return cardEl;
            }

            fetch(productsUrl)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }
                    return response.json();
                })
                .then((payload) => {
                    const products = asArray(payload);

                    if (products.length === 0) {
                        feedbackEl.textContent = 'Nenhum produto encontrado para exibir.';
                        return;
                    }

                    const fragment = document.createDocumentFragment();
                    products.forEach((product, index) => {
                        fragment.appendChild(createCard(product, index));
                    });

                    carouselEl.appendChild(fragment);
                    feedbackEl.textContent = '';
                })
                .catch(() => {
                    feedbackEl.textContent = 'Não foi possível carregar os produtos do arquivo JSON no momento.';
                });
        })();
    </script>
</body>

</html>