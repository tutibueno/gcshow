<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Categorias da Loja</h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/categorias/salvar') ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Descrição</label>
                                <input type="text" name="descricao" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ordem</label>
                                <input type="number" name="ordem" class="form-control" value="0">
                            </div>
                            <div class="form-group col-md-2 d-flex align-items-center">
                                <label class="mb-0 mt-4">
                                    <input type="checkbox" name="ativo" value="1" checked>
                                    Ativa
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar categoria</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Ordem</th>
                                <th>Status</th>
                                <th width="320">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categorias as $categoria): ?>
                                <tr>
                                    <td><?= $categoria['id'] ?></td>
                                    <td><?= esc($categoria['nome']) ?></td>
                                    <td><?= esc($categoria['descricao']) ?></td>
                                    <td><?= $categoria['ordem'] ?></td>
                                    <td><?= $categoria['ativo'] ? 'Ativa' : 'Inativa' ?></td>
                                    <td>
                                        <form action="<?= base_url('admin/categorias/atualizar/' . $categoria['id']) ?>" method="post" class="form-inline">
                                            <input type="text" name="nome" class="form-control form-control-sm mr-2 mb-2" value="<?= esc($categoria['nome']) ?>" required>
                                            <input type="text" name="descricao" class="form-control form-control-sm mr-2 mb-2" value="<?= esc($categoria['descricao']) ?>">
                                            <input type="number" name="ordem" class="form-control form-control-sm mr-2 mb-2" value="<?= $categoria['ordem'] ?>" style="width:80px;">
                                            <label class="mr-2 mb-2">
                                                <input type="checkbox" name="ativo" value="1" <?= $categoria['ativo'] ? 'checked' : '' ?>>
                                                Ativa
                                            </label>
                                            <button type="submit" class="btn btn-sm btn-info mr-2 mb-2">Atualizar</button>
                                            <a href="<?= base_url('admin/categorias/excluir/' . $categoria['id']) ?>" class="btn btn-sm btn-danger mb-2">Excluir</a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>
