<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\transportlogistics\common\models\TransportlogisticsDriver */

$this->title = 'Update Transportlogistics Driver: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transportlogistics Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transportlogistics-driver-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
