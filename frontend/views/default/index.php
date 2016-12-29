<?php

use common\modules\transportlogistics\frontend\assets\TransportlogisticsAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\widgets\Pjax;

TransportlogisticsAsset::register($this);
$this->title = 'Развозки';


$clients_array = $clientModel::find()->orderBy(['clientname' => SORT_ASC] )->all();
$address_array = $addressModel::find()->orderBy(['address' => SORT_ASC])->all();
$driver_array = $driverModel::find()->orderBy(['drivername' => SORT_ASC])->all();

?>

<?php if (Yii::$app->user->can('transportlogistics/create-request')){ ?>
    <div class="panel panel-default delivery__new-record-box">
        <div class="panel-heading">Добавление заявки<div class="icon glyphicon glyphicon-chevron-down"></div></div>
        <div class="panel-body">
            <?php
          //  Pjax::begin([]);
            $form = ActiveForm::begin([
                'id' => 'transportlogistics__new-record-form',
                'options' => [
                    'class' => 'form-horizontal',
                    'data-pjax' => 1,
                ],
                'fieldConfig' => [
                    'template' => "{label}\n{input}",
                ],
                'action' => '/transportlogistics/default/create-request',
            ]);
            ?>
            <div class="delivery__new-record-box__input-group">
                <?= $form->field($clientModel, 'clientname')->textInput(['autocomplete' => 'off']); ?>
                <?= $form->field($addressModel,'address')->textInput(['autocomplete' => 'off']); ?>
                <?= $form->field($recordModel, 'transporting_date')->textInput(['autocomplete' => 'off']);?>
                <?= $form->field($recordModel, 'transporting_time')->textInput(['autocomplete' => 'off']); ?>
                <?= $form->field($recordModel, 'size_cargo')->textInput(['autocomplete' => 'off']); ?>
                <?= $form->field($recordModel, 'driver_note')->textInput(['autocomplete' => 'off']); ?>
            </div>

            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success btn-sm dtn-addRecord ', 'pjax-data'=> true, 'title' => 'Добавить заявку']); ?>
            <?php ActiveForm::end(); ?>
            <?php // Pjax::end(); ?>
        </div>
    </div>
<?php  } ?>




<div class="toolbar-top">


    <div class="col-lg-4 col-sm-4 driver-box">
        <!-- спсиок водителей -->
        <?php

            if (count($driver_array) > 1) {
                $items = [0 => 'Все водители'] + ArrayHelper::map($driver_array, 'id', 'drivername');
            } else {
                $items = ArrayHelper::map($driver_array, 'id', 'drivername');
            }
            echo Html::dropDownList('drivers','0' ,$items, ['class' => 'btn driver-box__select']);

        ?>
        <!-- спсиок водителей -->
    </div>


    <div class="col-lg-4 col-sm-4">
        <div style=" font-size: 1em; font-size: 1.3em; height: 46px; line-height: 46px;">
            <div class="tool-bar__report-date-box" style="text-align: center;">
                <span class="tool-bar__report-date-box__date"> <?= date('d.m.y'); ?> </span>

                <span class="glyphicon glyphicon-calendar calendar-toggle" style="padding-left: 10pt; color:rgb(84, 84, 84);"></span>

                <div class="calendar-box">
                    <select class="calendar-box__month-select">
                        <option value="0">Январь</option>
                        <option value="1">Февраль</option>
                        <option value="2">Март</option>
                        <option value="3">Апрель</option>
                        <option value="4">Май</option>
                        <option value="5">Июнь</option>
                        <option value="6">Июль</option>
                        <option value="7">Август</option>
                        <option value="8">Сентябрь</option>
                        <option value="9">Октябрь</option>
                        <option value="10">Ноябрь</option>
                        <option value="11">Декабрь</option>
                    </select>
                    <input class="calendar-box__year-select" type="number" value="" min="2012" max="9999" size="4" />

                    <table class="calendar-box__table">
                        <thead>
                        <tr class="calendar-box__table__week">
                            <td>Пн</td>
                            <td>Вт</td>
                            <td>Ср</td>
                            <td>Чт</td>
                            <td>Пт</td>
                            <td>Сб</td>
                            <td>Вс</td>
                        </tr>
                        </thead>
                        <tbody class="calendar-box__table__tbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end toolbar-top -->

<!-- список нераспределенных заявок-->
<?php
$records = $recordModel::find()->where(['driver_id' => null])->all();
if (count($records) > null) { ?>
    <div class="panel panel-default request__panel">
        <div class="panel-heading">Нераспределенные заявки<div class="icon glyphicon glyphicon-chevron-down"></div></div>
        <div class="panel-body">
            <table class="request__table">
                <thead class="request__table__thead">
                <tr class="request__table__thead__tr">
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
                <tbody class="request__table__tbody">
                <?php
                $items = [null => 'Не решено'] + ArrayHelper::map($driver_array, 'id', 'drivername');

                foreach ($records as $item) {

                    $p_user = $managerModel::find()->select('p_username')->where(['user_id' => $item['responsible_manager']])->one();
                    $p_user = $p_user['p_username'];

                    $client_name = $clientModel::find()->select('clientname')->where(['id' => $item['client_id']])->one();
                    $client_name= $client_name['clientname'];

                    $address = $addressModel::find()->select('address')->where(['id' => $item['address_id']])->one();
                    $address= $address['address'];

                    $list .= '<tr><td class="request__table__tbody__client">'.$client_name.'</td>';
                    $list .= '<td class="request__table__tbody__address">'.$address.'</td>';
                    $list .= '<td class="request__table__tbody__transporting-time">'.$item['transporting_time'].'</td>';
                    $list .= '<td class="request__table__tbody__size-cargo">'.$item['size_cargo'].'</td>';
                    $list .= '<td class="request__table__tbody__driver-note">'.$item['driver-note'].'</td>';
                    $list .= '<td class="request__table__tbody__manager">'.$p_user.'</td>';
                    $list .= '<td class="request__table__tbody__driver">'.
                        Html::dropDownList('drivers','0' ,$items, []).
                        '</td></tr>';

                }
                echo $list;
                ?>
                </tbody>
            </table>
            <?= Html::button('Распределить', ['class' => 'btn btn-sm btn-success btn-done-request']); ?>
        </div>
    </div>
<?php } ?>

<div class="col-lg-12 col-sm-12 delivery">

    <div class="panel panel-default delivery-list__panel">
        <div class="panel-heading">Развозки<div class="icon glyphicon glyphicon-chevron-up"></div></div>
        <div class="panel-body">
            <div class="delivery-box">
                <div class="col-lg-6 delivery-box__driver">Пименов</div>

                <table class="delivery-box__point__table">
                    <thead class="delivery-box__point__table__thead">
                    <tr>
                        <td>№</td>
                        <td>Клиент</td>
                        <td>Адрес доставки</td>
                        <td>Время</td>
                        <td>Объем</td>
                        <td>Примечание</td>
                        <td>Менеджер</td>
                    </tr>
                    </thead>
                    <tbody class="delivery-box__point__table__tbody">
                    <tr>
                        <td class="delivery-box__point__table__tbody__row-number">1</td>
                        <td class="delivery-box__point__table__tbody__client">Ульба Групп</td>
                        <td class="delivery-box__point__table__tbody__address">Казахсатан. г. Москва, Лианозовский проезд, д.6</td>
                        <td class="delivery-box__point__table__tbody__time">10:00 - 17:00</td>
                        <td class="delivery-box__point__table__tbody__size">32к+33к+3к+6к(5п)</td>
                        <td class="delivery-box__point__table__tbody__driver-note">Везем и сдаем на палетах</td>
                        <td class="delivery-box__point__table__tbody__manager">Мауль</td>
                    </tr>

                    <tr>
                        <td class="delivery-box__point__table__tbody__row-number">2</td>
                        <td class="delivery-box__point__table__tbody__client">Зайцева</td>
                        <td class="delivery-box__point__table__tbody__address">Склад сервис, Коровинское шоссе, д.35, стр.2</td>
                        <td class="delivery-box__point__table__tbody__time"></td>
                        <td class="delivery-box__point__table__tbody__size">15к</td>
                        <td class="delivery-box__point__table__tbody__driver-note"></td>
                        <td class="delivery-box__point__table__tbody__manager">Кузнецова</td>
                    </tr>

                    <tr>
                        <td class="delivery-box__point__table__tbody__row-number">3</td>
                        <td class="delivery-box__point__table__tbody__client">Моспосуда</td>
                        <td class="delivery-box__point__table__tbody__address">Проспект Буденого д.37</td>
                        <td class="delivery-box__point__table__tbody__time"></td>
                        <td class="delivery-box__point__table__tbody__size">28к</td>
                        <td class="delivery-box__point__table__tbody__driver-note"></td>
                        <td class="delivery-box__point__table__tbody__manager">Хошаба</td>
                    </tr>

                    <tr>
                        <td class="delivery-box__point__table__tbody__row-number">4</td>
                        <td class="delivery-box__point__table__tbody__client">Поларшинова</td>
                        <td class="delivery-box__point__table__tbody__address">Деловые линии </td>
                        <td class="delivery-box__point__table__tbody__time"></td>
                        <td class="delivery-box__point__table__tbody__size">4к</td>
                        <td class="delivery-box__point__table__tbody__driver-note"></td>
                        <td class="delivery-box__point__table__tbody__manager">Генукова</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end of delivery -->