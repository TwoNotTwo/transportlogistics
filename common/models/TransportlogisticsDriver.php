<?php

namespace common\modules\transportlogistics\common\models;

use Yii;

/**
 * This is the model class for table "{{%transportlogistics_driver}}".
 *
 * @property integer $id
 * @property string $drivername
 * @property integer $status
 */
class TransportlogisticsDriver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transportlogistics_driver}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['drivername'], 'required'],
            [['status'], 'integer'],
            [['drivername'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'drivername' => 'ФИО водителя',
            'status' => 'Status',
        ];
    }
}
