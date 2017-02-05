<?php

use common\modules\transportlogistics\frontend\assets\TransportlogisticsAsset;

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

TransportlogisticsAsset::register($this);
$this->title = 'Развозки';
/**
 * Единая таблица на подобии экселевской. Но поля доступны в зависимости от роли пользователя и того, какое
 * состояние у записи все сортруется и изменяется динамически
 */
?>

<?php 
    if (Yii::$app->user->can('transportlogistics/create-request')){
        echo Html::a('Создать заявку','transportlogistics/default/create-request', ['class' => 'btn btn-primary']);
    }
?>


<div class="request-box">
    <table class="request-table">
        <thead class="request-table__thead">
        <tr class="request-table__thead__tr">
            <td>Клиент</td>
            <td>Адрес доставки</td>
            <td>Время</td>
            <td>Объем</td>
            <td>Примечание для водителя</td>
            <td>Менеджер</td>
            <td>Водитель</td>
        </tr>
        </thead>
        <tbody class="request-table__tbody">
        <tr class="request-table__tbody__tr">
            <td class="request-table__tbody__tr__client"></td>
            <td class="request-table__tbody__tr__address"></td>
            <td class="request-table__tbody__tr__time"></td>
            <td class="request-table__tbody__tr__size-cargo"></td>
            <td class="request-table__tbody__tr__driver-note"></td>
            <td class="request-table__tbody__tr__responsible-manager"></td>
            <td class="request-table__tbody__tr__driver"></td>
        </tr>
        </tbody>
    </table>

</div>
<div>
    
    <p>Менеджер - создание заявок на доставку заказа</p>
    <p>Наблюдатель - просмотр созданных заявок</p>
    <p>Менеджер - редактирование своих заявок</p>
    <p>-------------------------------------------------------------------</p>
    <p>Создай файл с переменными, в которых укажешь стил для таблиц, цвета и прочее. Хватит дублировать значения</p>
</div>
