<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\transportlogistics\common\models\TransportlogisticsDriver */

$this->title = 'Create Transportlogistics Driver';
$this->params['breadcrumbs'][] = ['label' => 'Transportlogistics Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transportlogistics-driver-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
