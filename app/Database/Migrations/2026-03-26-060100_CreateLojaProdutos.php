<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLojaProdutos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'categoria_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'sku' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => true,
            ],
            'resumo' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'imagem_capa' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'preco' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'preco_promocional' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'estoque' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'peso_gramas' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'altura_cm' => [
                'type' => 'DECIMAL',
                'constraint' => '8,2',
                'default' => 0,
            ],
            'largura_cm' => [
                'type' => 'DECIMAL',
                'constraint' => '8,2',
                'default' => 0,
            ],
            'comprimento_cm' => [
                'type' => 'DECIMAL',
                'constraint' => '8,2',
                'default' => 0,
            ],
            'usa_variacoes' => [
                'type' => 'TINYINT',
                'constraint' => 1,
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
        $this->forge->addKey('categoria_id');
        $this->forge->addUniqueKey('slug');
        $this->forge->addUniqueKey('sku');
        $this->forge->addForeignKey('categoria_id', 'loja_categorias', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('loja_produtos');
    }

    public function down()
    {
        $this->forge->dropTable('loja_produtos');
    }
}
