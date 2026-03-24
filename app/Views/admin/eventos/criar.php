<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Novo Evento</h1>
    </section>

    <section class="content">
        <div class="container-fluid">

            <form action="<?= base_url('admin/eventos/salvar') ?>" method="post" enctype="multipart/form-data">

                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="titulo" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="descricao" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Data</label>
                            <input type="date" name="data_evento" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Hora Início</label>
                            <input type="time" name="hora_inicio" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Hora Fim</label>
                            <input type="time" name="hora_fim" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Local</label>
                            <input type="text" name="local" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" name="cidade" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <input type="text" name="estado" class="form-control" maxlength="2">
                        </div>

                        <div class="form-group">
                            <label>Link para compra de ingressos</label>
                            <input type="text" name="ingressos_url" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Texto do botão</label>
                            <input type="text" name="ingressos_texto" class="form-control" placeholder="Ex: Comprar ingressos">
                        </div>

                        <div class="form-group">
                            <label>Imagem</label>
                            <input type="file" name="imagem" class="form-control">
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="destaque" value="1"> Evento em destaque</label>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="publicado" value="1" checked> Publicado</label>
                        </div>

                        <button type="submit" class="btn btn-success">Salvar</button>

                    </div>
                </div>

            </form>

        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>