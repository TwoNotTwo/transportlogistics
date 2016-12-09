<?php

namespace common\modules\transportlogistics\frontend\controllers;

use Yii;
use yii\web\Controller;

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
}
