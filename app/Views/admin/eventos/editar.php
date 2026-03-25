<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Editar Evento</h1>
    </section>

    <section class="content">
        <div class="container-fluid">

            <form action="<?= base_url('admin/eventos/atualizar/' . $evento['id']) ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="imagem_atual" value="<?= $evento['imagem'] ?>">

                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="titulo" class="form-control" value="<?= $evento['titulo'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="descricao" class="form-control"><?= $evento['descricao'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Data Início</label>
                            <input type="date" name="data_inicio" class="form-control" value="<?= $evento['data_inicio'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Data Fim</label>
                            <input type="date" name="data_fim" class="form-control" value="<?= $evento['data_fim'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Hora Início</label>
                            <input type="time" name="hora_inicio" class="form-control" value="<?= $evento['hora_inicio'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Hora Fim</label>
                            <input type="time" name="hora_fim" class="form-control" value="<?= $evento['hora_fim'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Local</label>
                            <input type="text" name="local" class="form-control" value="<?= $evento['local'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" name="cidade" class="form-control" value="<?= $evento['cidade'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <input type="text" name="estado" class="form-control" value="<?= $evento['estado'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Link para compra de ingressos</label>
                            <input type="text" name="ingressos_url" class="form-control" value="<?= $evento['ingressos_url'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Texto do botão</label>
                            <input type="text" name="ingressos_texto" class="form-control" value="<?= $evento['ingressos_texto'] ?>">
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="destaque" value="1" <?= $evento['destaque'] ? 'checked' : '' ?>>
                                Evento em destaque
                            </label>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="publicado" value="1" <?= $evento['publicado'] ? 'checked' : '' ?>>
                                Publicado
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Mapa do Google (iframe)</label>
                            <textarea name="mapa_iframe" class="form-control" rows="4"><?= $evento['mapa_iframe'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Imagem</label><br>
                            <?php if ($evento['imagem']): ?>
                                <img src="<?= base_url('uploads/eventos/' . $evento['imagem']) ?>" width="120"><br><br>
                            <?php endif; ?>
                            <input type="file" name="imagem" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success">Atualizar</button>

                    </div>
                </div>

            </form>

        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>