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
    <link rel="stylesheet" href="<?= base_url($assetPrefix . 'css/home.css') ?>">
</head>
<body>
    <header class="site-header">
        <img class="site-logo" src="<?= base_url($assetPrefix . 'logo.png') ?>" alt="Games Collection Show">
        <nav aria-label="Menu principal">
            <ul class="site-menu">
                <li><a href="#noticias">Últimas Notícias</a></li>
                <li><a href="#agenda">Agenda</a></li>
                <li><a href="#galeria">Galeria de Fotos</a></li>
                <li><a href="#produtos">Produtos</a></li>
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
                <li>Março: Encontro Retro Games</li>
                <li>Abril: Mostra de Consoles Clássicos</li>
                <li>Maio: Feira de Trocas e Produtos</li>
            </ul>
        </section>

        <section class="content-section" id="galeria">
            <h2 class="section-title">Galeria de Fotos</h2>
        </section>

        <section class="content-section" id="produtos">
            <h2 class="section-title">Produtos</h2>
        </section>
    </main>

    <footer class="site-footer">
        Games Collection Show - Todos os Direitos Reservados
    </footer>
</body>
</html>
