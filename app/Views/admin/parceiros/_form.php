<?php
$isEdit = ! empty($parceiro);
$nome = old('nome', $parceiro['nome'] ?? '');
$descricao = old('descricao', $parceiro['descricao'] ?? '');
$siteUrl = old('site_url', $parceiro['site_url'] ?? '');
$instagramUrl = old('instagram_url', $parceiro['instagram_url'] ?? '');
$tipo = old('tipo', $parceiro['tipo'] ?? 'normal');
$ordem = old('ordem', $parceiro['ordem'] ?? 0);
$ativo = old('ativo', (string) ($parceiro['ativo'] ?? 1));
?>

<?= csrf_field() ?>

<?php if (! empty($errors)): ?>
    <div class="alert alert-danger">
        <strong>Revise os dados informados.</strong>
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= esc($nome) ?>" maxlength="255" required>
            </div>

            <div class="form-group col-md-2">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="normal" <?= $tipo === 'normal' ? 'selected' : '' ?>>Normal</option>
                    <option value="premium" <?= $tipo === 'premium' ? 'selected' : '' ?>>Premium</option>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="ordem">Ordem</label>
                <input type="number" name="ordem" id="ordem" class="form-control" value="<?= esc($ordem) ?>" min="0" step="1">
            </div>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="4"><?= esc($descricao) ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="site_url">Site</label>
                <input type="url" name="site_url" id="site_url" class="form-control" value="<?= esc($siteUrl) ?>" maxlength="255" placeholder="https://">
            </div>

            <div class="form-group col-md-6">
                <label for="instagram_url">Instagram</label>
                <input type="url" name="instagram_url" id="instagram_url" class="form-control" value="<?= esc($instagramUrl) ?>" maxlength="255" placeholder="https://instagram.com/perfil">
            </div>
        </div>

        <div class="form-row align-items-start">
            <div class="form-group col-md-8">
                <label for="logo">Logo <?= $isEdit ? '(envie somente se quiser trocar)' : '' ?></label>
                <input type="file" name="logo" id="logo" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" <?= $isEdit ? '' : 'required' ?>>
                <small class="form-text text-muted">Formatos aceitos: JPG, PNG e WEBP. Tamanho máximo: 2 MB.</small>
            </div>

            <div class="form-group col-md-4">
                <label>Preview</label>
                <div class="border rounded bg-light d-flex align-items-center justify-content-center p-3" style="min-height: 140px;">
                    <img id="logoPreview" src="<?= $isEdit ? parceiro_logo_url($parceiro['logo']) : '' ?>" alt="Preview da logo" style="max-height: 110px; max-width: 100%; <?= $isEdit ? '' : 'display: none;' ?>">
                    <span id="logoPreviewEmpty" class="text-muted" <?= $isEdit ? 'style="display: none;"' : '' ?>>Nenhuma imagem selecionada</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="ativo" value="1" class="custom-control-input" id="ativo" <?= (string) $ativo === '1' ? 'checked' : '' ?>>
                <label class="custom-control-label" for="ativo">Ativo</label>
            </div>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="<?= base_url('admin/parceiros') ?>" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-success">Salvar</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('logo');
        const preview = document.getElementById('logoPreview');
        const empty = document.getElementById('logoPreviewEmpty');

        if (!input || !preview) return;

        input.addEventListener('change', function() {
            const file = input.files && input.files[0];
            if (!file) return;

            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            if (empty) empty.style.display = 'none';
        });
    });
</script>
