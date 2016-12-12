<?php

namespace common\modules\transportlogistics\frontend\controllers;

use Yii;
use yii\web\Controller;
use  common\modules\transportlogistics\common\models\TransportlogisticsDriver;

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
        $model = new TransportlogisticsDriver();
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
