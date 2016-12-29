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
            'driver_id' => $this->integer(),
            'client_id' => $this->integer(),
            'address_id' => $this->integer(),
            'order_number' => $this->string(), //номер заказа
            'order_date' => $this->string(), //дата заказа
            'order_file' => $this->string(), //ссыдка на файл с опсианием заказа - накладная
            'transporting_date' => $this->date(), //предполагаемая дата доставки
            'transporting_time' => $this->string(), //пометка о времени доставки
            'size_cargo' => $this->string(), //объем собранного заказа
            //'common_note' => $this->string(), //премеяание для общего пользования
            'driver_note' => $this->string(), //примечание ТОЛЬКО для водителя
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

    public function down(){
        $this->dropTable('{{%transportlogistics_driver}}');
        $this->dropTable('{{%transportlogistics_client}}');
        $this->dropTable('{{%transportlogistics_address}}');
        $this->dropTable('{{%transportlogistics_record}}');
        $this->dropTable('{{%transportlogistics_record_history}}');
    }
}
