<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Institucional</h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/institucional/salvar') ?>" method="post">
                        <div class="form-group">
                            <label>Quem somos</label>
                            <textarea name="quem_somos" class="form-control" rows="6"><?= esc($institucional['quem_somos'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Missão e valores</label>
                            <textarea name="missao_valores" class="form-control" rows="6"><?= esc($institucional['missao_valores'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Equipe organizadora</label>
                            <textarea name="equipe_organizadora" class="form-control" rows="6"><?= esc($institucional['equipe_organizadora'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Contatos</label>
                            <textarea name="contatos" class="form-control" rows="6"><?= esc($institucional['contatos'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Telefone WhatsApp</label>
                            <input type="text" name="telefone_whatsapp" class="form-control" value="<?= esc($institucional['telefone_whatsapp'] ?? '') ?>" placeholder="5511999999999">
                        </div>

                        <div class="form-group">
                            <label>URL Instagram</label>
                            <input type="text" name="instagram_url" class="form-control" value="<?= esc($institucional['instagram_url'] ?? '') ?>" placeholder="https://www.instagram.com/seu_perfil/">
                        </div>

                        <div class="form-group">
                            <label>URL Facebook</label>
                            <input type="text" name="facebook_url" class="form-control" value="<?= esc($institucional['facebook_url'] ?? '') ?>" placeholder="https://www.facebook.com/sua-pagina">
                        </div>

                        <div class="form-group">
                            <label>URL YouTube</label>
                            <input type="text" name="youtube_url" class="form-control" value="<?= esc($institucional['youtube_url'] ?? '') ?>" placeholder="https://www.youtube.com/@seucanal">
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar informações</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>
