<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Galeria</h1>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <form action="<?= base_url('admin/galeria/salvar') ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Evento</label>
                            <select name="evento_id" class="form-control">
                                <?php foreach ($eventos as $evento): ?>
                                    <option value="<?= $evento['id'] ?>">
                                        <?= $evento['titulo'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tipo</label>
                            <select name="tipo" class="form-control">
                                <option value="foto">Foto</option>
                                <option value="video">Vídeo (YouTube)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Imagem</label>
                            <input type="file" name="arquivo" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>URL do vídeo (YouTube)</label>
                            <input type="text" name="video_url" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="titulo" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="destaque" value="1">
                                Foto em destaque (aparece na página inicial)
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success">Enviar</button>

                    </form>

                </div>
            </div>

            <hr>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Evento</th>
                        <th>Tipo</th>
                        <th>Mídia</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($galeria as $g): ?>
                        <tr>
                            <td><?= $g['id'] ?></td>
                            <td><?= $g['evento'] ?></td>
                            <td><?= $g['tipo'] ?></td>
                            <td>
                                <?php if ($g['tipo'] == 'foto'): ?>
                                    <img src="<?= base_url('uploads/galeria/' . $g['arquivo']) ?>" width="100">
                                <?php else: ?>
                                    <a href="<?= $g['video_url'] ?>" target="_blank">Ver vídeo</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/galeria/excluir/' . $g['id']) ?>" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>