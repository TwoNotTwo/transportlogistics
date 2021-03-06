<?php

use yii\db\Migration;

class m161212_102648_transportlogistics_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        /*
         * transportlogistics_driver - водители
         */
        $this->createTable('{{%transportlogistics_driver}}', [
            'id' => $this->primaryKey(),
            'drivername' => $this->string()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);


        /*
         * transportlogistics_client - клиенты
         */
        $this->createTable('{{%transportlogistics_client}}', [
            'id' => $this->primaryKey(),
            'clientname' => $this->string()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);


        /*
         * transportlogistics_address - адреса доставок
         */
        $this->createTable('{{%transportlogistics_address}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);


        /*
         * transportlogistics_record - запись о доставке
         */
        $this->createTable('{{%transportlogistics_record}}', [
            'id' => $this->primaryKey(),
            'driver_id' => $this->integer(3),
            'client_id' => $this->integer(4)->notNull(),
            'address_id' => $this->integer()->notNull(),
            'transporting_date' => $this->date(),
            'transporting_time' => $this->string(),
            'size_cargo' => $this->string(),
            'note' => $this->string(),
            'responsible_manager' => $this->integer()->notNull(), //кто из менеджеров (сотрудников) добавил запись
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);


        /*
         * %transportlogistics_record_history - история изменений в записях
         */
        $this->createTable('{{%transportlogistics_record_history}}', [
            'id' => $this->primaryKey(),
            'record_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'action_datetime' => $this->dateTime(),
            'description' => $this->string()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);

    }
}
