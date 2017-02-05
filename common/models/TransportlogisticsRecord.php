<?php

namespace common\modules\transportlogistics\common\models;

use Yii;

/**
 * This is the model class for table "{{%transportlogistics_record}}".
 *
 * @property integer $id
 * @property integer $driver_id
 * @property integer $client_id
 * @property integer $address_id
 * @property string $order_number
 * @property string $order_date
 * @property string $order_file
 * @property string $transporting_date
 * @property string $transporting_time
 * @property string $size_cargo
 * @property string $driver_note
 * @property integer $responsible_manager
 * @property integer $stage
 * @property integer $status
 */
class TransportlogisticsRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transportlogistics_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'client_id', 'address_id', 'responsible_manager', 'stage', 'status'], 'integer'],
            [['transporting_date'], 'safe'],
            [['client_id', 'address_id', 'responsible_manager'], 'required'],
            [['order_number', 'order_date', 'order_file', 'transporting_time', 'size_cargo', 'driver_note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_id' => 'Driver ID',
            'client_id' => 'Client ID',
            'address_id' => 'Address ID',
            'order_number' => 'Order Number',
            'order_date' => 'Order Date',
            'order_file' => 'Order File',
            'transporting_date' => 'Transporting Date',
            'transporting_time' => 'Transporting Time',
            'size_cargo' => 'Size Cargo',
            'driver_note' => 'Driver Note',
            'responsible_manager' => 'Responsible Manager',
            'stage' => 'Stage',
            'status' => 'Status',
        ];
    }
}
