<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\transportlogistics\common\models\TransportlogisticsDriver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transportlogistics-driver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'drivername')->textInput(['maxlength' => true]) ?>

    <?php// $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
