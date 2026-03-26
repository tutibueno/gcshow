<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLojaClientesEnderecos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'documento' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
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
        $this->forge->addKey('email');
        $this->forge->createTable('loja_clientes');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cliente_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'apelido' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ],
            'cep' => [
                'type' => 'VARCHAR',
                'constraint' => 12,
            ],
            'logradouro' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
            ],
            'numero' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'complemento' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => true,
            ],
            'bairro' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => true,
            ],
            'cidade' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
            ],
            'principal' => [
                'type' => 'TINYINT',
                'constraint' => 1,
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
        $this->forge->addKey('cliente_id');
        $this->forge->addForeignKey('cliente_id', 'loja_clientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loja_enderecos');
    }

    public function down()
    {
        $this->forge->dropTable('loja_enderecos');
        $this->forge->dropTable('loja_clientes');
    }
}
