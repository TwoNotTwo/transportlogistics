<?php

namespace common\modules\transportlogistics\common\models;

use Yii;

/**
 * This is the model class for table "{{%transportlogistics_address}}".
 *
 * @property integer $id
 * @property string $address
 */
class TransportlogisticsAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transportlogistics_address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Адрес',
        ];
    }
}
