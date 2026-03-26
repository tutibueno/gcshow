<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsletterSubscribers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'active',
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('token');
        $this->forge->addKey('status');
        $this->forge->createTable('newsletter_subscribers');
    }

    public function down()
    {
        $this->forge->dropTable('newsletter_subscribers');
    }
}
