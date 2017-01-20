<?php

use common\modules\transportlogistics\frontend\assets\TransportlogisticsAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

TransportlogisticsAsset::register($this);
$this->title = 'Развозки';
/**
 * Единая таблица на подобии экселевской. Но поля доступны в зависимости от роли пользователя и того, какое
 * состояние у записи все сортруется и изменяется динамически
 */
?>

<table class="request-table">
    <thead class="request-table__thead">
    <tr class="request-table__thead__tr">
        <!--<td>№</td> -->
        <td>Клиент</td>
        <td>Адрес доставки</td>
        <td>Время</td>
        <td>Объем</td>
        <td>Примечание</td>
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