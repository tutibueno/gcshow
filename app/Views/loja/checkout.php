<?= $this->include('layout/header') ?>

<main class="home-content">
    <section class="content-section">
        <h1 class="section-title">Checkout</h1>
    </section>

    <section class="content-section gallery-event-card">
        <form action="<?= base_url('loja/finalizar-pedido') ?>" method="post">
            <div class="store-checkout-grid">
                <div class="store-checkout-form">
                    <div class="store-field">
                        <label>Nome</label>
                        <input type="text" name="nome" class="store-select" required>
                    </div>
                    <div class="store-field">
                        <label>E-mail</label>
                        <input type="email" name="email" class="store-select" required>
                    </div>
                    <div class="store-field">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="store-select">
                    </div>
                    <div class="store-field">
                        <label>Documento</label>
                        <input type="text" name="documento" class="store-select">
                    </div>
                    <div class="store-field">
                        <label>CEP</label>
                        <input type="text" name="cep" class="store-select" value="<?= esc($frete_info['cep'] ?? '') ?>" required>
                    </div>
                    <div class="store-field">
                        <label>Logradouro</label>
                        <input type="text" name="logradouro" class="store-select" required>
                    </div>
                    <div class="store-field-row store-field-row-2">
                        <div class="store-field">
                            <label>Número</label>
                            <input type="text" name="numero" class="store-select">
                        </div>
                        <div class="store-field">
                            <label>Complemento</label>
                            <input type="text" name="complemento" class="store-select">
                        </div>
                    </div>
                    <div class="store-field-row store-field-row-address">
                        <div class="store-field">
                            <label>Bairro</label>
                            <input type="text" name="bairro" class="store-select">
                        </div>
                        <div class="store-field">
                            <label>Cidade</label>
                            <input type="text" name="cidade" class="store-select" required>
                        </div>
                        <div class="store-field">
                            <label>UF</label>
                            <input type="text" name="estado" class="store-select" maxlength="2" required>
                        </div>
                    </div>
                    <div class="store-field">
                        <label>Pagamento</label>
                        <select name="metodo_pagamento" class="store-select" required>
                            <option value="pix">PIX</option>
                            <option value="cartao">Cartão</option>
                        </select>
                    </div>
                    <div class="store-field">
                        <label>Observações</label>
                        <textarea name="observacoes" class="store-select" rows="4"></textarea>
                    </div>
                </div>

                <div class="store-summary">
                    <h3>Resumo do pedido</h3>
                    <?php foreach ($itens as $item): ?>
                        <p><?= esc($item['nome']) ?> x <?= $item['quantidade'] ?><br><small>R$ <?= number_format((float) $item['subtotal'], 2, ',', '.') ?></small></p>
                    <?php endforeach; ?>
                    <hr>
                    <p>Subtotal: <strong>R$ <?= number_format((float) $subtotal, 2, ',', '.') ?></strong></p>
                    <p>Frete: <strong>R$ <?= number_format((float) $frete, 2, ',', '.') ?></strong></p>
                    <p>Total: <strong>R$ <?= number_format((float) $total, 2, ',', '.') ?></strong></p>
                    <button type="submit" class="btn btn-success">Finalizar pedido</button>
                </div>
            </div>
        </form>
    </section>
</main>

<?= $this->include('layout/footer') ?>
