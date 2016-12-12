<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\transportlogistics\common\models\TransportlogisticsClient */

$this->title = 'Create Transportlogistics Client';
$this->params['breadcrumbs'][] = ['label' => 'Transportlogistics Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transportlogistics-client-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
