<?php

namespace common\modules\transportlogistics\common\models;

use yii\base\Model;
use Yii;


class CreateRequest extends Model
{

    
    public $client;
    public $address;
    public $transporting_time;
    public $transporting_date;
    public $driver_note;
    public $responsible_manager;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['responsible_manager'], 'integer'],
            [['transporting_date'], 'safe'],
            [['client', 'address', 'responsible_manager'], 'required'],
            [['client', 'address', 'transporting_time', 'driver_note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client' => 'Клиент',
            'address' => 'Адресс',
            'transporting_date' => 'Дата доставки',
            'transporting_time' => 'Время/временной интервал',
            'driver_note' => 'Примечание для водителя',
            'responsible_manager' => 'Responsible Manager',
        ];
    }
}
