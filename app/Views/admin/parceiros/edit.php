<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Editar Parceiro</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('admin/parceiros/atualizar/' . $parceiro['id']) ?>" method="post" enctype="multipart/form-data">
                <?= $this->include('admin/parceiros/_form') ?>
            </form>
        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>
