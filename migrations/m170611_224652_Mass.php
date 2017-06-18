<?php

use yii\db\Schema;
use yii\db\Migration;

class m170611_224652_Mass extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%auth_assignment}}',[
            'item_name'=> $this->string(64)->notNull(),
            'user_id'=> $this->string(64)->notNull(),
            'created_at'=> $this->integer(11)->null()->defaultValue(null),
        ], $tableOptions);

        $this->addPrimaryKey('pk_on_auth_assignment','{{%auth_assignment}}',['item_name','user_id']);

        $this->createTable('{{%auth_item}}',[
            'name'=> $this->string(64)->notNull(),
            'type'=> $this->smallInteger(6)->notNull(),
            'description'=> $this->text()->null()->defaultValue(null),
            'rule_name'=> $this->string(64)->null()->defaultValue(null),
            'data'=> $this->binary()->null()->defaultValue(null),
            'created_at'=> $this->integer(11)->null()->defaultValue(null),
            'updated_at'=> $this->integer(11)->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('rule_name','{{%auth_item}}',['rule_name'],false);
        $this->createIndex('idx-auth_item-type','{{%auth_item}}',['type'],false);
        $this->addPrimaryKey('pk_on_auth_item','{{%auth_item}}',['name']);

        $this->createTable('{{%auth_item_child}}',[
            'parent'=> $this->string(64)->notNull(),
            'child'=> $this->string(64)->notNull(),
        ], $tableOptions);

        $this->createIndex('child','{{%auth_item_child}}',['child'],false);
        $this->addPrimaryKey('pk_on_auth_item_child','{{%auth_item_child}}',['parent','child']);

        $this->createTable('{{%auth_rule}}',[
            'name'=> $this->string(64)->notNull(),
            'data'=> $this->binary()->null()->defaultValue(null),
            'created_at'=> $this->integer(11)->null()->defaultValue(null),
            'updated_at'=> $this->integer(11)->null()->defaultValue(null),
        ], $tableOptions);

        $this->addPrimaryKey('pk_on_auth_rule','{{%auth_rule}}',['name']);

        $this->createTable('{{%backups}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'filename'=> $this->string(255)->notNull(),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->string(45)->null()->defaultValue(null),
        ], $tableOptions);


        $this->createTable('{{%categories}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'name'=> $this->string(255)->notNull(),
            'description'=> $this->text()->notNull(),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('categories_name_unique','{{%categories}}',['name'],true);

        $this->createTable('{{%courses}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'name'=> $this->string(255)->notNull(),
            'description'=> $this->text()->notNull(),
            'duration'=> $this->integer(11)->notNull(),
            'costos'=> $this->string(255)->notNull(),
            'category_id'=> $this->integer(10)->unsigned()->notNull(),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('courses_name_unique','{{%courses}}',['name'],true);
        $this->createIndex('courses_category_id_foreign','{{%courses}}',['category_id'],false);

        $this->createTable('{{%instructors}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'user_id'=> $this->integer(10)->unsigned()->notNull(),
            'schedule_id'=> $this->integer(10)->unsigned()->notNull(),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('instructors_user_id_foreign','{{%instructors}}',['user_id'],false);
        $this->createIndex('instructors_schedule_id_foreign','{{%instructors}}',['schedule_id'],false);

        $this->createTable('{{%interest_lists}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'user_id'=> $this->integer(10)->unsigned()->notNull(),
            'course_id'=> $this->integer(10)->unsigned()->notNull(),
            'start_date'=> $this->datetime()->null()->defaultValue(null),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('interest_lists_user_id_foreign','{{%interest_lists}}',['user_id'],false);
        $this->createIndex('interest_lists_course_id_foreign','{{%interest_lists}}',['course_id'],false);

        $this->createTable('{{%payments}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'preregister_id'=> $this->integer(10)->unsigned()->notNull(),
            'amount'=> $this->double(8, 2)->notNull(),
            'payment_type'=> "enum('D', 'C', 'E', 'H') NOT NULL",
            'movements'=> $this->integer(11)->notNull(),
            'payment_date'=> $this->datetime()->notNull(),
            'remaining_amount'=> $this->double(8, 2)->notNull(),
            'comments'=> $this->text()->null()->defaultValue(null),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('payments_preregister_id_foreign','{{%payments}}',['preregister_id'],false);

        $this->createTable('{{%postulates}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'user_id'=> $this->integer(10)->unsigned()->notNull(),
            'schedule_id'=> $this->integer(10)->unsigned()->notNull(),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('postulates_user_id_foreign','{{%postulates}}',['user_id'],false);
        $this->createIndex('postulates_schedule_id_foreign','{{%postulates}}',['schedule_id'],false);

        $this->createTable('{{%preregisters}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'user_id'=> $this->integer(10)->unsigned()->notNull(),
            'schedule_id'=> $this->integer(10)->unsigned()->notNull(),
            'preregister_date'=> $this->datetime()->notNull(),
            'status'=> $this->smallInteger(1)->notNull(),
            'comments'=> $this->text()->null()->defaultValue(null),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('preregisters_user_id_foreign','{{%preregisters}}',['user_id'],false);
        $this->createIndex('preregisters_schedule_id_foreign','{{%preregisters}}',['schedule_id'],false);

        $this->createTable('{{%registers}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'user_id'=> $this->integer(10)->unsigned()->notNull(),
            'schedule_id'=> $this->integer(10)->unsigned()->notNull(),
            'asistence'=> $this->smallInteger(1)->notNull(),
            'asistence_number'=> $this->integer(11)->notNull(),
            'personal_bill'=> $this->smallInteger(1)->notNull(),
            'comments'=> $this->text()->null()->defaultValue(null),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('registers_user_id_foreign','{{%registers}}',['user_id'],false);
        $this->createIndex('registers_schedule_id_foreign','{{%registers}}',['schedule_id'],false);

        $this->createTable('{{%schedules}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'course_id'=> $this->integer(10)->unsigned()->notNull(),
            'start_date'=> $this->datetime()->notNull(),
            'end_date'=> $this->datetime()->notNull(),
            'duration'=> $this->integer(11)->notNull(),
            'start_hour'=> $this->string(255)->notNull(),
            'end_hour'=> $this->string(255)->notNull(),
            'classroom'=> $this->string(255)->notNull(),
            'monday'=> $this->smallInteger(1)->notNull(),
            'tuesday'=> $this->smallInteger(1)->notNull(),
            'wednesday'=> $this->smallInteger(1)->notNull(),
            'thursday'=> $this->smallInteger(1)->notNull(),
            'friday'=> $this->smallInteger(1)->notNull(),
            'saturday'=> $this->smallInteger(1)->notNull(),
            'comments'=> $this->text()->null()->defaultValue(null),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('schedules_course_id_foreign','{{%schedules}}',['course_id'],false);

        $this->createTable('{{%settings}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'key'=> $this->string(255)->notNull(),
            'name'=> $this->string(255)->notNull(),
            'description'=> $this->string(255)->null()->defaultValue(null),
            'value'=> $this->string(255)->null()->defaultValue(null),
            'field'=> $this->text()->notNull(),
            'active'=> $this->smallInteger(4)->notNull(),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);


        $this->createTable('{{%user}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'username'=> $this->string(255)->notNull(),
            'password'=> $this->string(300)->notNull(),
            'auth_key'=> $this->string(255)->null()->defaultValue(null),
            'access_token'=> $this->string(255)->null()->defaultValue(null),
            'name'=> $this->string(255)->notNull(),
            'lastname'=> $this->string(45)->notNull(),
            'email'=> $this->string(255)->notNull(),
            'ci'=> $this->integer(10)->unsigned()->null()->defaultValue(null),
            'phone_mobile'=> $this->string(255)->null()->defaultValue(null),
            'phone_home'=> $this->string(255)->null()->defaultValue(null),
            'created_at'=> $this->timestamp()->null()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at'=> $this->timestamp()->null()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('users_email_unique','{{%user}}',['email'],true);
        $this->addForeignKey(
            'fk_auth_assignment_item_name',
            '{{%auth_assignment}}', 'item_name',
            '{{%auth_item}}', 'name',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_auth_item_rule_name',
            '{{%auth_item}}', 'rule_name',
            '{{%auth_rule}}', 'name',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_auth_item_child_parent',
            '{{%auth_item_child}}', 'parent',
            '{{%auth_item}}', 'name',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_auth_item_child_child',
            '{{%auth_item_child}}', 'child',
            '{{%auth_item}}', 'name',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_courses_category_id',
            '{{%courses}}', 'category_id',
            '{{%categories}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_instructors_schedule_id',
            '{{%instructors}}', 'schedule_id',
            '{{%schedules}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_instructors_user_id',
            '{{%instructors}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_interest_lists_course_id',
            '{{%interest_lists}}', 'course_id',
            '{{%courses}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_interest_lists_user_id',
            '{{%interest_lists}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_payments_preregister_id',
            '{{%payments}}', 'preregister_id',
            '{{%preregisters}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_postulates_schedule_id',
            '{{%postulates}}', 'schedule_id',
            '{{%schedules}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_postulates_user_id',
            '{{%postulates}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_preregisters_schedule_id',
            '{{%preregisters}}', 'schedule_id',
            '{{%schedules}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_preregisters_user_id',
            '{{%preregisters}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_registers_schedule_id',
            '{{%registers}}', 'schedule_id',
            '{{%schedules}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_registers_user_id',
            '{{%registers}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_schedules_course_id',
            '{{%schedules}}', 'course_id',
            '{{%courses}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_auth_assignment_item_name', '{{%auth_assignment}}');
            $this->dropForeignKey('fk_auth_item_rule_name', '{{%auth_item}}');
            $this->dropForeignKey('fk_auth_item_child_parent', '{{%auth_item_child}}');
            $this->dropForeignKey('fk_auth_item_child_child', '{{%auth_item_child}}');
            $this->dropForeignKey('fk_courses_category_id', '{{%courses}}');
            $this->dropForeignKey('fk_instructors_schedule_id', '{{%instructors}}');
            $this->dropForeignKey('fk_instructors_user_id', '{{%instructors}}');
            $this->dropForeignKey('fk_interest_lists_course_id', '{{%interest_lists}}');
            $this->dropForeignKey('fk_interest_lists_user_id', '{{%interest_lists}}');
            $this->dropForeignKey('fk_payments_preregister_id', '{{%payments}}');
            $this->dropForeignKey('fk_postulates_schedule_id', '{{%postulates}}');
            $this->dropForeignKey('fk_postulates_user_id', '{{%postulates}}');
            $this->dropForeignKey('fk_preregisters_schedule_id', '{{%preregisters}}');
            $this->dropForeignKey('fk_preregisters_user_id', '{{%preregisters}}');
            $this->dropForeignKey('fk_registers_schedule_id', '{{%registers}}');
            $this->dropForeignKey('fk_registers_user_id', '{{%registers}}');
            $this->dropForeignKey('fk_schedules_course_id', '{{%schedules}}');
            $this->dropPrimaryKey('pk_on_auth_assignment','{{%auth_assignment}}');
            $this->dropTable('{{%auth_assignment}}');
            $this->dropPrimaryKey('pk_on_auth_item','{{%auth_item}}');
            $this->dropTable('{{%auth_item}}');
            $this->dropPrimaryKey('pk_on_auth_item_child','{{%auth_item_child}}');
            $this->dropTable('{{%auth_item_child}}');
            $this->dropPrimaryKey('pk_on_auth_rule','{{%auth_rule}}');
            $this->dropTable('{{%auth_rule}}');
            $this->dropTable('{{%backups}}');
            $this->dropTable('{{%categories}}');
            $this->dropTable('{{%courses}}');
            $this->dropTable('{{%instructors}}');
            $this->dropTable('{{%interest_lists}}');
            $this->dropPrimaryKey('pk_on_migration','{{%migration}}');
            $this->dropTable('{{%migration}}');
            $this->dropTable('{{%payments}}');
            $this->dropTable('{{%postulates}}');
            $this->dropTable('{{%preregisters}}');
            $this->dropTable('{{%registers}}');
            $this->dropTable('{{%schedules}}');
            $this->dropTable('{{%settings}}');
            $this->dropTable('{{%user}}');
    }
}
