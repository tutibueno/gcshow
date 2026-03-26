<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLojaProdutosComplementos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'produto_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'arquivo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'ordem' => [
                'type' => 'INT',
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
        $this->forge->addKey('produto_id');
        $this->forge->addForeignKey('produto_id', 'loja_produtos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loja_produto_imagens');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'produto_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'sku' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
            ],
            'tamanho' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => true,
            ],
            'cor' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => true,
            ],
            'preco_adicional' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'estoque' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'ativo' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
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
        $this->forge->addKey('produto_id');
        $this->forge->addForeignKey('produto_id', 'loja_produtos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loja_produto_variacoes');
    }

    public function down()
    {
        $this->forge->dropTable('loja_produto_variacoes');
        $this->forge->dropTable('loja_produto_imagens');
    }
}
