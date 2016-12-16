<?php

use common\modules\transportlogistics\frontend\assets\TransportlogisticsAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

TransportlogisticsAsset::register($this);
$this->title = 'Развозки';

$clients_array = $clientModel::find()->orderBy(['clientname' => SORT_ASC] )->all();
$address_array = $addressModel::find()->orderBy(['address' => SORT_ASC])->all();
$driver_array = $driverModel::find()->orderBy(['drivername' => SORT_ASC])->all();

?>

<?php if (Yii::$app->user->can('transportlogistics/create-request')){ ?>
        <div class="panel panel-default delivery__new-record-box">
            <div class="panel-heading">Добавление заявки</div>
            <div class="panel-body">
            <?php
              $form = ActiveForm::begin([
                  'id' => 'transportlogistics__new-record-form',
                  'options' => [
                      'class' => 'form-horizontal',
                  ],
                  'fieldConfig' => [
                      'template' => "{label}\n{input}",
                  ],
                  'action' => 'transportlogistics/default/create-request',
              ]);
            ?>


            <div class="delivery__new-record-box__input-group">
                <?= $form->field($clientModel, 'clientname')->textInput(['autocomplete' => 'off']); ?>

                <?= $form->field($addressModel,'address')->textInput(['autocomplete' => 'off']); ?>
                <?= $form->field($recordModel, 'transporting_date')->textInput(['autocomplete' => 'off']);?>
                <?= $form->field($recordModel, 'transporting_time')->textInput(['autocomplete' => 'off']); ?>
                <?= $form->field($recordModel, 'size_cargo')->textInput(['autocomplete' => 'off']); ?>
                <?= $form->field($recordModel, 'note')->textInput(['autocomplete' => 'off']); ?>

            </div>
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-success dtn-addRecord ', 'title' => 'Добавить заявку']); ?>
            <?php ActiveForm::end(); ?>
        </div>
<?php  } ?>




<div class="toolbar-top">

    <!-- список нераспределенных заявок-->
    <?php

        $records = $recordModel::find()->where(['driver_id' => null])->all();
        if (count($records) > null) {
            $list = '<div>';
            foreach ($records as $item) {
                $list .= '<span>'.$clients_array[$item['client_id']]['clientname'].'</span>';
                $list .= '<span>'.$address_array[$item['address_id']]['address'].'</span>';
                $list .= '<span>'.$item['size_cargo'].'</span>';
                $list .= '<span>'.$item['note'].'</span>';
            }
            $list .= '</div>';
            echo $list;
        }
    ?>

    <div class="col-lg-4 col-sm-4 driver-box">
<!-- спсиок водителей -->
    <?php

        //$drivers = $driver_array;//$driverModel::find()->orderBy('drivername ASC')->all();
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
                <span class="tool-bar__report-date-box__date">
                    <?= date('d.m.y'); ?>
                </span>
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

<div class="col-lg-12 col-sm-12 delivery">
<div class="delivery-list">
    <div class="delivery-box">
        <div class="col-lg-6 delivery-box__driver">Пименов</div>
            <?= Html::a('', '#', ['class'=> 'btn btn-default glyphicon glyphicon-print transportlogistics_print-list-requests', 'title' => 'Распечатать']);//title' => Yii::t('cashbox', 'Печатать')]); ?>
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
                    <td class="delivery-box__point__table__tbody__address">Казахсатан. г. Москва, Лианозовский проезд , д.6</td>
                    <td class="delivery-box__point__table__tbody__time">10:00 - 17:00</td>
                    <td class="delivery-box__point__table__tbody__size">32к+33к+3к+6к(5п)</td>
                    <td class="delivery-box__point__table__tbody__note">Везем и сдаем на палетах</td>
                    <td class="delivery-box__point__table__tbody__manager">Мауль</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">2</td>
                    <td class="delivery-box__point__table__tbody__client">Зайцева</td>
                    <td class="delivery-box__point__table__tbody__address">Склад сервис, Коровинское шоссе ,д 35, стр2</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">15к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Кузнецова</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">3</td>
                    <td class="delivery-box__point__table__tbody__client">Моспосуда</td>
                    <td class="delivery-box__point__table__tbody__address">Проспект Буденого д.37</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">28к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Хошаба</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">4</td>
                    <td class="delivery-box__point__table__tbody__client">Поларшинова</td>
                    <td class="delivery-box__point__table__tbody__address">Деловые линии </td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">4к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Генукова</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="delivery-box">
        <div class="delivery-box__driver">Деграф</div>
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
                    <td class="delivery-box__point__table__tbody__client">Озон</td>
                    <td class="delivery-box__point__table__tbody__address">Москва</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">38к(2п)</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Мауль</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">2</td>
                    <td class="delivery-box__point__table__tbody__client">Профскарлет</td>
                    <td class="delivery-box__point__table__tbody__address">Алтуфьевское ш</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">9к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Мауль</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">3</td>
                    <td class="delivery-box__point__table__tbody__client">Мир Посуды</td>
                    <td class="delivery-box__point__table__tbody__address">Рейл Континент Югорский проезд</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">40к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Мауль</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">4</td>
                    <td class="delivery-box__point__table__tbody__client">Кудрявцева</td>
                    <td class="delivery-box__point__table__tbody__address">ТК Спектр, Ярославское шоссе, 2Е</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">4к</td>
                    <td class="delivery-box__point__table__tbody__note">Можно отвезти в четверг</td>
                    <td class="delivery-box__point__table__tbody__manager">Шугай</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="delivery-box">
        <div class="delivery-box__driver">Меробов</div>
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
            <tbody>
                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">1</td>
                    <td class="delivery-box__point__table__tbody__client">"Онлайн Трейд" ООО</td>
                    <td class="delivery-box__point__table__tbody__address">г. Химки, ул. Заводская, д.2а (Алмаз - Химки), корп. 28</td>
                    <td class="delivery-box__point__table__tbody__time">11:00</td>
                    <td class="delivery-box__point__table__tbody__size">44к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Корякин</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">2</td>
                    <td class="delivery-box__point__table__tbody__client">Чеканина Л.А. </td>
                    <td class="delivery-box__point__table__tbody__address">Красногорский р-н, Нахабино ПГТ</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">2к</td>
                    <td class="delivery-box__point__table__tbody__note">Деньги</td>
                    <td class="delivery-box__point__table__tbody__manager">Кирюхина</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">3</td>
                    <td class="delivery-box__point__table__tbody__client">ГринПаркМастер</td>
                    <td class="delivery-box__point__table__tbody__address">Истринский р-н, Павловское д., Садовый центр</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">8к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Кирюхина</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">4</td>
                    <td class="delivery-box__point__table__tbody__client">Мурза А.В.</td>
                    <td class="delivery-box__point__table__tbody__address">г. Истра</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">11к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Кирюхина</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">5</td>
                    <td class="delivery-box__point__table__tbody__client">Птицына Н.М.</td>
                    <td class="delivery-box__point__table__tbody__address">Истринский р-н, Букаревское с/п, Глебовский п.</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">2к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Кирюхина</td>
                </tr>

                <tr>
                    <td class="delivery-box__point__table__tbody__row-number">6</td>
                    <td class="delivery-box__point__table__tbody__client">Павловское  ПО</td>
                    <td class="delivery-box__point__table__tbody__address">Истринский р-н, Павло-Слободское с/п, Павловская Слобода с</td>
                    <td class="delivery-box__point__table__tbody__time"></td>
                    <td class="delivery-box__point__table__tbody__size">7к</td>
                    <td class="delivery-box__point__table__tbody__note"></td>
                    <td class="delivery-box__point__table__tbody__manager">Кирюхина</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div> <!-- end of delivery -->

