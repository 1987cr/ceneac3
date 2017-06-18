<?php

use yii\db\Schema;
use yii\db\Migration;

class m170611_225435_auth_itemDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%auth_item}}',
                           ["name", "type", "description", "rule_name", "data", "created_at", "updated_at"],
                            [
    [
        'name' => 'admin',
        'type' => '1',
        'description' => 'Usuario Administrador',
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497211478',
        'updated_at' => '1497213330',
    ],
    [
        'name' => 'Cursos - Actualizar',
        'type' => '2',
        'description' => 'El usuario puede actualizar cursos',
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497213211',
        'updated_at' => '1497213211',
    ],
    [
        'name' => 'Cursos - Crear',
        'type' => '2',
        'description' => 'El usuario puede crear cursos',
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497211541',
        'updated_at' => '1497213133',
    ],
    [
        'name' => 'Cursos - Eliminar',
        'type' => '2',
        'description' => 'El usuario puede eliminar cursos',
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497213157',
        'updated_at' => '1497213157',
    ],
    [
        'name' => 'Cursos - Leer',
        'type' => '2',
        'description' => 'El usuario puede consultar cursos',
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497213190',
        'updated_at' => '1497213190',
    ],
    [
        'name' => 'Cursos - Todos',
        'type' => '2',
        'description' => 'El usuario puede realizar todas las acciones con los cursos',
        'rule_name' => null,
        'data' => null,
        'created_at' => '1497213271',
        'updated_at' => '1497213298',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%auth_item}} CASCADE');
    }
}
