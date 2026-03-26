<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header d-flex justify-content-between align-items-center">
        <h1>Produtos</h1>
        <a href="<?= base_url('admin/produtos/criar') ?>" class="btn btn-primary">Novo produto</a>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php if (empty($produtos)): ?>
                <div class="card">
                    <div class="card-body text-center text-muted">
                        Nenhum produto cadastrado.
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($produtos as $produto): ?>
                        <?php
                        $precoAtual = (float) ($produto['preco_promocional'] ?: $produto['preco']);
                        $precoOriginal = (float) $produto['preco'];
                        $temPromocao = !empty($produto['preco_promocional']) && $precoAtual < $precoOriginal;
                        $imagem = $produto['imagem_capa']
                            ? base_url('uploads/produtos/' . $produto['imagem_capa'])
                            : base_url('public/banner_padrao.jpg');
                        ?>
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex align-items-stretch">
                            <div class="card w-100 shadow-sm">
                                <img
                                    src="<?= $imagem ?>"
                                    alt="<?= esc($produto['nome']) ?>"
                                    class="card-img-top"
                                    style="height: 220px; object-fit: cover;"
                                >
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge badge-secondary">#<?= $produto['id'] ?></span>
                                        <span class="badge <?= $produto['ativo'] ? 'badge-success' : 'badge-danger' ?>">
                                            <?= $produto['ativo'] ? 'Ativo' : 'Inativo' ?>
                                        </span>
                                    </div>

                                    <h3 class="h5 mb-1"><?= esc($produto['nome']) ?></h3>
                                    <p class="text-muted mb-2"><?= esc($produto['categoria_nome'] ?: 'Sem categoria') ?></p>

                                    <?php if (!empty($produto['resumo'])): ?>
                                        <p class="text-sm text-muted mb-3"><?= esc(mb_strimwidth($produto['resumo'], 0, 100, '...')) ?></p>
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <?php if ($temPromocao): ?>
                                            <div class="text-muted text-sm" style="text-decoration: line-through;">
                                                R$ <?= number_format($precoOriginal, 2, ',', '.') ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="h5 mb-0 text-primary">
                                            R$ <?= number_format($precoAtual, 2, ',', '.') ?>
                                        </div>
                                    </div>

                                    <div class="mt-auto">
                                        <p class="mb-3">
                                            <strong>Estoque:</strong> <?= (int) $produto['estoque'] ?>
                                        </p>
                                        <div class="d-flex">
                                            <a href="<?= base_url('admin/produtos/editar/' . $produto['id']) ?>" class="btn btn-info btn-sm mr-2 flex-fill">Editar</a>
                                            <a href="<?= base_url('admin/produtos/excluir/' . $produto['id']) ?>" class="btn btn-danger btn-sm flex-fill">Excluir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>
