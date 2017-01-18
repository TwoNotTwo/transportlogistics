<?php

use common\modules\transportlogistics\frontend\assets\TransportlogisticsAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

TransportlogisticsAsset::register($this);
$this->title = 'Развозки';
/**
 * Единая таблица на подобии экселевской. Но поля доступны в зависимости от роли пользователя и того, какое состояние у записи
 * все сортруется и изменяется динамически
 *
 */
?>

