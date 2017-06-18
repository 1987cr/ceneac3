<?php

use yii\db\Schema;
use yii\db\Migration;

class m170611_225530_auth_assignmentDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%auth_assignment}}',
                           ["item_name", "user_id", "created_at"],
                            [
    [
        'item_name' => 'admin',
        'user_id' => '1',
        'created_at' => '1497211512',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%auth_assignment}} CASCADE');
    }
}
