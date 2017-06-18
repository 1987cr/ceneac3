<?php

use yii\db\Schema;
use yii\db\Migration;

class m170611_225516_auth_item_childDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%auth_item_child}}',
                           ["parent", "child"],
                            [
    [
        'parent' => 'Cursos - Todos',
        'child' => 'Cursos - Actualizar',
    ],
    [
        'parent' => 'Cursos - Todos',
        'child' => 'Cursos - Crear',
    ],
    [
        'parent' => 'Cursos - Todos',
        'child' => 'Cursos - Eliminar',
    ],
    [
        'parent' => 'Cursos - Todos',
        'child' => 'Cursos - Leer',
    ],
    [
        'parent' => 'admin',
        'child' => 'Cursos - Todos',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%auth_item_child}} CASCADE');
    }
}
