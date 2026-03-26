<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Novo produto</h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('admin/produtos/salvar') ?>" method="post" enctype="multipart/form-data">
                <?= $this->include('admin/produtos/_form') ?>
            </form>
        </div>
    </section>
</div>

<?= $this->include('admin/layout/footer') ?>
