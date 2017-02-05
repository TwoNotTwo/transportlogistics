<?php

namespace common\modules\transportlogistics\frontend\controllers;

use common\modules\transportlogistics\common\models\TransportlogisticsAddress;
use common\modules\transportlogistics\common\models\TransportlogisticsClient;
use common\modules\transportlogistics\common\models\TransportlogisticsDriver;
use common\modules\transportlogistics\common\models\TransportlogisticsRecord;
use twonottwo\db_rbac\models\Profile;

use common\modules\transportlogistics\common\models\CreateRequest;
use Yii;
use yii\web\Controller;

//use  common\modules\transportlogistics\common\models\TransportlogisticsDriver;
//use  common\modules\transportlogistics\common\models\TransportlogisticsDriver;
/**
 * 10 - создана менеджером
 * 15 - водитель назначен, но не передана в доставку
 */


/**
 * Default controller for the `transportlogistics` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateRequest()
    {
        if (Yii::$app->user->can('transportlogistics/create-request')) {
            $requestModel = new CreateRequest();
            return $this->render('createRequest', ['requestModel' => $requestModel]);
        }
    }

    public function actionGetClientAndAddressList()
    {
        $records = TransportlogisticsClient::find()->where(['status' => 10])->all();
        $answer = '';
        for ($i = 0; $i < count($records); $i++) {
            foreach ($records[$i] as $value)
                $answer .= $value . ',';
            $answer = substr($answer, 0, strlen($answer) - 1);
            ($i < count($records) - 1) ? $answer .= ';' : false;
        }

        $records = TransportlogisticsAddress::find()->where(['status' => 10])->all();
        $answer .= '&';
        for ($i = 0; $i < count($records); $i++) {
            foreach ($records[$i] as $value)
                $answer .= $value . ',';
            $answer = substr($answer, 0, strlen($answer) - 1);
            ($i < count($records) - 1) ? $answer .= ';' : false;
        }
        return $answer;
    }

    public function actionGetClientList()
    {
        $records = TransportlogisticsClient::find()->where(['status' => 10])->all();
        $answer = '';
        for ($i = 0; $i < count($records); $i++) {
            foreach ($records[$i] as $value)
                $answer .= $value . ',';
            $answer = substr($answer, 0, strlen($answer) - 1);
            ($i < count($records) - 1) ? $answer .= ';' : false;
        }
        return $answer;
    }

    public function actionGetAddressList()
    {
        $records = TransportlogisticsAddress::find()->where(['status' => 10])->all();
        $answer = '';
        for ($i = 0; $i < count($records); $i++) {
            foreach ($records[$i] as $value)
                $answer .= $value . ',';
            $answer = substr($answer, 0, strlen($answer) - 1);
            ($i < count($records) - 1) ? $answer .= ';' : false;
        }
        return $answer;
    }
}
