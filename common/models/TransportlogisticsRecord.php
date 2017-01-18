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
 * @property string $transporting_date
 * @property string $transporting_time
 * @property string $driver_note
 * @property integer $responsible_manager
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
            [['driver_id', 'client_id', 'address_id', 'responsible_manager'], 'integer'],
            [['client_id', 'address_id', 'responsible_manager'], 'required'],
           // [['transporting_date'], 'safe'],
            [['transporting_time', 'transporting_date', 'size_cargo', 'driver_note'], 'string', 'max' => 255],
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
            'address_id' => 'Адресс доставки',
            'transporting_date' => 'Дата доставки',
            'transporting_time' => 'Пометка о времени',
            'size_cargo' => 'Объем заказа',
            'driver_note' => 'Примечание для водителя',
            'responsible_manager' => 'Менеджер',
        ];
    }
}
