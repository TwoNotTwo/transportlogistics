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

        //transportlogistics_driver - водители
        $this->createTable('{{%transportlogistics_driver}}', [
            'id' => $this->primaryKey(),
            'drivername' => $this->string()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);


        //transportlogistics_client - клиенты
        $this->createTable('{{%transportlogistics_client}}', [
            'id' => $this->primaryKey(),
            'clientname' => $this->string()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);


        //transportlogistics_address - адреса доставок
        $this->createTable('{{%transportlogistics_address}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);


        //transportlogistics_record - запись о доставке
        $this->createTable('{{%transportlogistics_record}}', [
            'id' => $this->primaryKey(),
            'driver_id' => $this->integer(),
            'client_id' => $this->integer(),
            'address_id' => $this->integer(),
            'order_number' => $this->string(), //номер заказа
            'order_date' => $this->string(), //дата заказа
            'order_file' => $this->string(), //ссыдка на файл с опсианием заказа - накладная
            'transporting_date' => $this->date(), //предполагаемая дата доставки
            //'correct_transporting_date' => $this->date(), //дата на которую доставку еренесли
            'transporting_time' => $this->string(), //пометка о времени доставки
            'size_cargo' => $this->string(), //объем собранного заказа
            //'common_note' => $this->string(), //премеяание для общего пользования
            'driver_note' => $this->string(), //примечание ТОЛЬКО для водителя
            'responsible_manager' => $this->integer()->notNull(), //кто из менеджеров (сотрудников) добавил запись
            //'number_of_date_changes' => $this->integer()->defaultValue(0),
            'stage' => $this->integer()->defaultValue(1),
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);


        //%transportlogistics_record_history - история изменений в записях
        $this->createTable('{{%transportlogistics_record_history}}', [
            'id' => $this->primaryKey(),
            'record_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'action_datetime' => $this->dateTime(),
            'description' => $this->string()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(10),
        ], $tableOptions);

        $this->execute($this->AddRolesAndPermissions());
        $this->execute($this->AssignRolesAndPermissions());
    }


    function AddRolesAndPermissions()
    {
        $_at = new DateTime();
        $_at = $_at->getTimestamp();

        return "INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
            ('tl-role-guest', 1, 'Транспортна логистика (ТЛ) - наблюдатель', NULL, NULL, '$_at', '$_at'),
            ('tl-role-logist', 1, 'ТЛ - логист', NULL, NULL, '$_at', '$_at'),
            ('tl-role-manager', 1, 'ТЛ - менеджер', NULL, NULL, '$_at', '$_at'),
            ('tl-role-storekeeper', 1, 'ТЛ - кладовщик', NULL, NULL, '$_at', '$_at'),
            ('transportlogistics', 2, 'Транспортная логистика (ТЛ) - доступ', NULL, NULL, '$_at', '$_at'),
            ('transportlogistics/set-delivery-date', 2, 'ТЛ - перенос/изменение даты доставки', NULL, NULL, '$_at', '$_at'),
            ('transportlogistics/create-request', 2, 'ТЛ - создание заявки на доставку заказа', NULL, NULL, '$_at', '$_at'),
            ('transportlogistics/set-responsible-driver', 2, 'ТЛ - назначение водителя, который везет заказ', NULL, NULL, '$_at', '$_at'),
            ('transportlogistics/set-size-cargo', 2, 'ТЛ - установка объема заказа', NULL, NULL, '$_at', '$_at')";
    }

    function AssignRolesAndPermissions()
    {
        return "INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
            ('tl-role-guest', 'transportlogistics'),
            
            ('tl-role-logist', 'transportlogistics'),
            ('tl-role-logist', 'transportlogistics/set-delivery-date'),
            ('tl-role-logist', 'transportlogistics/set-responsible-driver'),
            
            ('tl-role-manager', 'transportlogistics'),
            ('tl-role-manager', 'transportlogistics/set-delivery-date'),
            ('tl-role-manager', 'transportlogistics/create-request'),

            ('tl-role-storekeeper', 'transportlogistics'),
            ('tl-role-storekeeper', 'transportlogistics/set-size-cargo')";

    }


    public function down()
    {
        $this->dropTable('{{%transportlogistics_driver}}');
        $this->dropTable('{{%transportlogistics_client}}');
        $this->dropTable('{{%transportlogistics_address}}');
        $this->dropTable('{{%transportlogistics_record}}');
        $this->dropTable('{{%transportlogistics_record_history}}');


        $this->execute("
            DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = 'tl-role-guest' AND `auth_item_child`.`child` = 'transportlogistics';
            
            DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = 'tl-role-logist' AND `auth_item_child`.`child` = 'transportlogistics';
            DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = 'tl-role-logist' AND `auth_item_child`.`child` = 'transportlogistics/set-delivery-date';
            DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = 'tl-role-logist' AND `auth_item_child`.`child` = 'transportlogistics/set-responsible-driver';
            
            DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = 'tl-role-manager' AND `auth_item_child`.`child` = 'transportlogistics';
            DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = 'tl-role-manager' AND `auth_item_child`.`child` = 'transportlogistics/set-delivery-date';
            DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = 'tl-role-manager' AND `auth_item_child`.`child` = 'transportlogistics/create-request';
            
            
            DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = 'tl-role-storekeeper' AND `auth_item_child`.`child` = 'transportlogistics';
            DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = 'tl-role-storekeeper' AND `auth_item_child`.`child` = 'transportlogistics/set-size-cargo';");

        $this->execute("
            DELETE FROM `auth_item` WHERE `auth_item`.`name` = 'tl-role-guest';
            DELETE FROM `auth_item` WHERE `auth_item`.`name` = 'tl-role-logist';
            DELETE FROM `auth_item` WHERE `auth_item`.`name` = 'tl-role-manager';
            DELETE FROM `auth_item` WHERE `auth_item`.`name` = 'tl-role-storekeeper';
            DELETE FROM `auth_item` WHERE `auth_item`.`name` = 'transportlogistics';
            DELETE FROM `auth_item` WHERE `auth_item`.`name` = 'transportlogistics/set-delivery-date';
            DELETE FROM `auth_item` WHERE `auth_item`.`name` = 'transportlogistics/create-request';
            DELETE FROM `auth_item` WHERE `auth_item`.`name` = 'transportlogistics/set-responsible-driver';
            DELETE FROM `auth_item` WHERE `auth_item`.`name` = 'transportlogistics/set-size-cargo';
        ");

    }
}
