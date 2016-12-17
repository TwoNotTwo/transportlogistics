<?php

namespace common\modules\transportlogistics\frontend\controllers;

use common\modules\transportlogistics\backend\controllers\DriverController;
use common\modules\transportlogistics\common\models\TransportlogisticsClient;
use common\modules\transportlogistics\common\models\TransportlogisticsRecord;
use common\modules\transportlogistics\common\models\TransportlogisticsAddress;
use common\modules\transportlogistics\common\models\TransportlogisticsDriver;
use twonottwo\db_rbac\models\Profile;
use Yii;
use yii\web\Controller;
//use  common\modules\transportlogistics\common\models\TransportlogisticsDriver;
//use  common\modules\transportlogistics\common\models\TransportlogisticsDriver;

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
        $recordModel = new TransportlogisticsRecord();
        $clientModel = new TransportlogisticsClient();
        $addressModel = new TransportlogisticsAddress();
        $driverModel = new TransportlogisticsDriver();
        $managerModel = new Profile();

        return $this->render('index', [
            'recordModel' => $recordModel,
            'clientModel' => $clientModel,
            'addressModel' => $addressModel,
            'driverModel' => $driverModel,
            'managerModel' =>$managerModel,
        ]);
    }

    public function actionCreateRequest(){
        $recordModel = new TransportlogisticsRecord();
        $clientModel = new TransportlogisticsClient();
        $addressModel = new TransportlogisticsAddress();

        $url = '/transportlogistics';
        if ($clientModel->load(Yii::$app->request->post()) && $addressModel->load(Yii::$app->request->post()) && $recordModel->load(Yii::$app->request->post()) ){

            $client = TransportlogisticsClient::find()->where(['clientname' => $clientModel['clientname']] )->one();
            if (count($client) == null) {

                $clientModel->save();
                $client = $clientModel->id;
            } else $client = $client->id;

            $address = TransportlogisticsAddress::find()->where(['address' => $addressModel['address']])->one();
            if(count($address) == null) {
                $addressModel->save();
                $address = $addressModel->id;
            } else $address = $address->id;

            $manager = Yii::$app->user->id;

            $recordModel->client_id = $client;
            $recordModel->address_id = $address;
            $recordModel->responsible_manager = $manager;
            $recordModel->save();
        }

        $this->goBack($url);
    }

    public function actionGetClientAndAddressList(){
        $records = TransportlogisticsClient::find()->where(['status' => 10])->all();
        $answer = '';
        for ($i=0; $i<count($records); $i++ ){
            foreach ($records[$i] as $value)
                $answer .= $value .',';
            $answer = substr($answer, 0, strlen($answer)-1);
            ($i < count($records)-1) ? $answer .= ';': false;
        }

        $records = TransportlogisticsAddress::find()->where(['status' => 10])->all();
        $answer .= '&';
        for ($i=0; $i<count($records); $i++ ){
            foreach ($records[$i] as $value)
                $answer .= $value .',';
            $answer = substr($answer, 0, strlen($answer)-1);
            ($i < count($records)-1) ? $answer .= ';': false;
        }
        return $answer;
    }

    public function actionGetClientList(){
        $records = TransportlogisticsClient::find()->where(['status' => 10])->all();
        $answer = '';
        for ($i=0; $i<count($records); $i++ ){
            foreach ($records[$i] as $value)
                $answer .= $value .',';
            $answer = substr($answer, 0, strlen($answer)-1);
            ($i < count($records)-1) ? $answer .= ';': false;
        }
        return $answer;
    }

    public function actionGetAddressList(){
        $records = TransportlogisticsAddress::find()->where(['status' => 10])->all();
        $answer = '';
        for ($i=0; $i<count($records); $i++ ){
            foreach ($records[$i] as $value)
                $answer .= $value .',';
            $answer = substr($answer, 0, strlen($answer)-1);
            ($i < count($records)-1) ? $answer .= ';': false;
        }
        return $answer;
    }
}
