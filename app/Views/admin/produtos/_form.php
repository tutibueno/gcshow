<?php
$produto = $produto ?? [];
$variacoesTexto = '';
if (!empty($variacoes)) {
    $linhas = [];
    foreach ($variacoes as $variacao) {
        $linhas[] = implode('|', [
            $variacao['nome'] ?? '',
            $variacao['tamanho'] ?? '',
            $variacao['cor'] ?? '',
            $variacao['estoque'] ?? 0,
            $variacao['preco_adicional'] ?? 0,
            $variacao['sku'] ?? '',
        ]);
    }
    $variacoesTexto = implode(PHP_EOL, $linhas);
}
?>

<div class="card">
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Categoria</label>
                <select name="categoria_id" class="form-control">
                    <option value="">Sem categoria</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>" <?= (string) ($produto['categoria_id'] ?? '') === (string) $categoria['id'] ? 'selected' : '' ?>>
                            <?= esc($categoria['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="<?= esc($produto['nome'] ?? '') ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label>SKU</label>
                <input type="text" name="sku" class="form-control" value="<?= esc($produto['sku'] ?? '') ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Preço</label>
                <input type="number" step="0.01" name="preco" class="form-control" value="<?= esc($produto['preco'] ?? '0.00') ?>">
            </div>
            <div class="form-group col-md-3">
                <label>Preço promocional</label>
                <input type="number" step="0.01" name="preco_promocional" class="form-control" value="<?= esc($produto['preco_promocional'] ?? '') ?>">
            </div>
            <div class="form-group col-md-2">
                <label>Estoque</label>
                <input type="number" name="estoque" class="form-control" value="<?= esc($produto['estoque'] ?? 0) ?>">
            </div>
            <div class="form-group col-md-2 d-flex align-items-center">
                <label class="mb-0 mt-4">
                    <input type="checkbox" name="usa_variacoes" value="1" <?= !empty($produto['usa_variacoes']) ? 'checked' : '' ?>>
                    Usa variações
                </label>
            </div>
            <div class="form-group col-md-2 d-flex align-items-center">
                <label class="mb-0 mt-4">
                    <input type="checkbox" name="ativo" value="1" <?= !isset($produto['ativo']) || !empty($produto['ativo']) ? 'checked' : '' ?>>
                    Ativo
                </label>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Peso (g)</label>
                <input type="number" name="peso_gramas" class="form-control" value="<?= esc($produto['peso_gramas'] ?? 0) ?>">
            </div>
            <div class="form-group col-md-3">
                <label>Altura (cm)</label>
                <input type="number" step="0.01" name="altura_cm" class="form-control" value="<?= esc($produto['altura_cm'] ?? 0) ?>">
            </div>
            <div class="form-group col-md-3">
                <label>Largura (cm)</label>
                <input type="number" step="0.01" name="largura_cm" class="form-control" value="<?= esc($produto['largura_cm'] ?? 0) ?>">
            </div>
            <div class="form-group col-md-3">
                <label>Comprimento (cm)</label>
                <input type="number" step="0.01" name="comprimento_cm" class="form-control" value="<?= esc($produto['comprimento_cm'] ?? 0) ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Resumo</label>
            <textarea name="resumo" class="form-control" rows="2"><?= esc($produto['resumo'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control" rows="5"><?= esc($produto['descricao'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label>Imagens do produto</label>
            <input type="file" name="imagens[]" class="form-control" multiple>
            <?php if (!empty($imagens)): ?>
                <div class="mt-3 d-flex flex-wrap">
                    <?php foreach ($imagens as $imagem): ?>
                        <img src="<?= base_url('uploads/produtos/' . $imagem['arquivo']) ?>" width="120" class="mr-2 mb-2 rounded border">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Variações</label>
            <textarea name="variacoes_texto" class="form-control" rows="6" placeholder="Nome|Tamanho|Cor|Estoque|Preco adicional|SKU"><?= esc($variacoesTexto) ?></textarea>
            <small class="form-text text-muted">Uma linha por variação. Exemplo: Camiseta P|P|Preta|10|5.00|CAM-P-PRETA</small>
        </div>

        <button type="submit" class="btn btn-primary">Salvar produto</button>
    </div>
</div>
