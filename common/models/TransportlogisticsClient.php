<?php

namespace common\modules\transportlogistics\common\models;

use Yii;

/**
 * This is the model class for table "{{%transportlogistics_client}}".
 *
 * @property integer $id
 * @property string $clientname
 * @property integer $status
 */
class TransportlogisticsClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transportlogistics_client}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientname'], 'required'],
            [['status'], 'integer'],
            [['clientname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clientname' => 'Клиент',
            'status' => 'Status',
        ];
    }
}
