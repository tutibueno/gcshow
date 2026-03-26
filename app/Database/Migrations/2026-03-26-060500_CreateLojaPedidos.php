<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLojaPedidos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'numero' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'cliente_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'endereco_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'aguardando_pagamento',
            ],
            'status_pagamento' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'pendente',
            ],
            'metodo_pagamento' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'metodo_envio' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
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
            'desconto' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'observacoes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'codigo_rastreio' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
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
        $this->forge->addUniqueKey('numero');
        $this->forge->addForeignKey('cliente_id', 'loja_clientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('endereco_id', 'loja_enderecos', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('loja_pedidos');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'pedido_id' => [
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
            'produto_nome' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
            ],
            'variacao_nome' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true,
            ],
            'sku' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
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
        $this->forge->addForeignKey('pedido_id', 'loja_pedidos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produto_id', 'loja_produtos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('variacao_id', 'loja_produto_variacoes', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('loja_pedido_itens');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'pedido_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pedido_id', 'loja_pedidos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loja_pedido_historicos');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'pedido_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'transacao_id' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => true,
            ],
            'gateway' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => true,
            ],
            'metodo' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'pendente',
            ],
            'valor' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'payload' => [
                'type' => 'LONGTEXT',
                'null' => true,
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
        $this->forge->addForeignKey('pedido_id', 'loja_pedidos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loja_pagamentos');
    }

    public function down()
    {
        $this->forge->dropTable('loja_pagamentos');
        $this->forge->dropTable('loja_pedido_historicos');
        $this->forge->dropTable('loja_pedido_itens');
        $this->forge->dropTable('loja_pedidos');
    }
}
