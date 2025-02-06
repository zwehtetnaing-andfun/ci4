<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Coments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'article_id' => [
                'type'           => 'INT',
                'constraint'     => 6,
                'unsigned'       => true,
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('article_id','articles','id');
        $this->forge->createTable('coments');
    }

    public function down()
    {
        $this->forge->dropTable('coments');
    }
}
