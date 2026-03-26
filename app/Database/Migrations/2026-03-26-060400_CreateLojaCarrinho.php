<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLojaCarrinho extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'sessao_id' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'cliente_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'frete' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('sessao_id');
        $this->forge->addForeignKey('cliente_id', 'loja_clientes', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('loja_carrinhos');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'carrinho_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'produto_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'variacao_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'quantidade' => [
                'type' => 'INT',
                'default' => 1,
            ],
            'preco_unitario' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('carrinho_id', 'loja_carrinhos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produto_id', 'loja_produtos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('variacao_id', 'loja_produto_variacoes', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('loja_carrinho_itens');
    }

    public function down()
    {
        $this->forge->dropTable('loja_carrinho_itens');
        $this->forge->dropTable('loja_carrinhos');
    }
}
