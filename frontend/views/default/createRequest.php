<?php
/**
 * Created by PhpStorm.
 * User: Pentalgin
 * Date: 04.02.2017
 * Time: 22:19
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use common\modules\transportlogistics\frontend\assets\CreateRequestAsset;

$this->title = 'Создание заявки';
CreateRequestAsset::register($this);
?>

<?php
    $form = ActiveForm::begin(['id' => 'form-create__request']);
?>
    <?= $form->field($requestModel, 'client')->textInput(['autofocus' => true]); ?>
    <?= $form->field($requestModel, 'address')->textInput(); ?>
    <?= $form->field($requestModel, 'transporting_date')->textInput(); ?>
    <?= $form->field($requestModel, 'transporting_time')->textInput(); ?>
    <?= $form->field($requestModel, 'driver_note')->textInput(); ?>
    <?= Html::submitButton('Создать заявку', ['class' => 'btn btn-primary']); ?>
<?php ActiveForm::end(); ?>