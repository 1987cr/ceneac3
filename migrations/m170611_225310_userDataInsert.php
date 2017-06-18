<?php

use yii\db\Schema;
use yii\db\Migration;

class m170611_225310_userDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%user}}',
                           ["id", "username", "password", "auth_key", "access_token", "name", "lastname", "email", "ci", "phone_mobile", "phone_home", "created_at", "updated_at"],
                            [
    [
        'id' => '1',
        'username' => 'admin',
        'password' => '$2y$13$mZ6jpMomhRDzXl27df59Z.3qAekW6sUIsmSOquIUwx5qOOueU5T9K',
        'auth_key' => '',
        'access_token' => '',
        'name' => 'admin',
        'lastname' => 'admin',
        'email' => 'admin@ceneac.com',
        'ci' => '18004591',
        'phone_mobile' => '',
        'phone_home' => '',
        'created_at' => '2017-02-07 01:41:58',
        'updated_at' => '2017-02-07 01:41:58',
    ],
    [
        'id' => '4',
        'username' => 'test',
        'password' => '$2y$13$D.1fvdq0p3CjEgN6LGwxwO7mbLJNdIRG9g/WbWUWLoG8PKocWawla',
        'auth_key' => 'vwRkit6Ka-N18y1cEyJ4AL79OYlKmDHy',
        'access_token' => null,
        'name' => 'test',
        'lastname' => 'test',
        'email' => 'test@ceneac.com',
        'ci' => '12345678',
        'phone_mobile' => '',
        'phone_home' => '',
        'created_at' => '2017-03-05 02:25:26',
        'updated_at' => '2017-03-05 02:25:26',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%user}} CASCADE');
    }
}
