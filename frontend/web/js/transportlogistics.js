
//список клиентов
var client_list;

//список адресо
var address_list;


$(document).ready(function(){
    welcome();
    resizeDeliveryList();
    getClientAndAddressList();
/*
    getClientList();
    getAddressList();
*/
    //показать/скрыть панель создания заявки
    $('.delivery__new-record-box .panel-heading').on('click', function(){
        $('.delivery__new-record-box .panel-body').toggle();

        $('.field-transportlogisticsclient-clientname input').focus();

        if ($('.delivery__new-record-box .panel-heading .icon').hasClass('glyphicon-chevron-down')){
            $('.delivery__new-record-box .panel-heading .icon').attr('class', 'icon glyphicon glyphicon-chevron-up');
        } else {
            $('.delivery__new-record-box .panel-heading .icon').attr('class', 'icon glyphicon glyphicon-chevron-down');
        }

        resizeDeliveryList();
    });

    //показать/скрыть панель нераспределенных заявки
    $('.request__panel .panel-heading').on('click', function(){
        $('.request__panel .panel-body').toggle();

        if ($('.request__panel .panel-heading .icon').hasClass('glyphicon-chevron-down')){
            $('.request__panel .panel-heading .icon').attr('class', 'icon glyphicon glyphicon-chevron-up');
        } else {
            $('.request__panel .panel-heading .icon').attr('class', 'icon glyphicon glyphicon-chevron-down');
        }

        resizeDeliveryList();
    });

    //показать/скрыть панель развозки
    $('.delivery-list__panel .panel-heading').on('click', function(){
        $('.delivery-list__panel .panel-body').toggle();

        if ($('.delivery-list__panel .panel-heading .icon').hasClass('glyphicon-chevron-down')){
            $('.delivery-list__panel .panel-heading .icon').attr('class', 'icon glyphicon glyphicon-chevron-up');
        } else {
            $('.delivery-list__panel .panel-heading .icon').attr('class', 'icon glyphicon glyphicon-chevron-down');
        }

        resizeDeliveryList();
    });

    // отмена отправки данных из формы заявки по нажатию Enter
    $('#transportlogistics__new-record-form').on('keydown' , function(event){
        if (event.keyCode == KEY_ENTER){
            event.preventDefault();
        }
    });

    $('.delivery__new-record-box__date__input').on('focusout', function(){
        $(this).val(dateMask($(this).val()));
    });

    //автозаполнение
    /** клиент */
    $('.field-transportlogisticsclient-clientname input').on('keyup', function (event) {
        if (event.keyCode != KEY_TAB && event.keyCode != KEY_SHIFT) {
            $(this).ludwig_autocomplete({
                list: client_list,
                minChar: 2,
                displayList: true,
                capitalLetter: true
            }, event);
        }
    });
    /** клиент */

    /** адрес */
    $('.field-transportlogisticsaddress-address input').on('keyup', function (event) {
        if (event.keyCode != KEY_TAB && event.keyCode != KEY_SHIFT) {
            $(this).ludwig_autocomplete({
                list: address_list,
                minChar: 2,
                displayList: true
            }, event);
        }
    });
    /** адрес */
    /** отслеживание момента заполнения input через autocomplete */


    $(document).bind('clickOnListItem', function (event) {
    });


    /** отслеживание момента заполнения input через autocomplete */
    $(document).bind('autocompleteDone', function (event, input) {
        removeIdActiveInput();
        removeDropDownList();
    });

});

    $('.form-control').on('keydown', function(event){
        if (event.keyCode == KEY_ENTER && !usingList()){
            console.log('enter is pressed');
            getNextInput($(this)).focus();
        }
    });


function getClientAndAddressList(){
    $.ajax({
        url: '/transportlogistics/default/get-client-and-address-list',
        type: 'POST',
        async: true,
        success: function(answer){
            var arr = answer.split('&');

            setClientList(createArrayFromString(arr[0]));
            setAddressList(createArrayFromString(arr[1]));
        },
        error: function(answer){
            console.log('Ошибка получения списка клиентов и адресов. # '+answer);
        }
    });
}

function getClientList(){
    $.ajax({
        url: '/transportlogistics/default/get-client-list',
        type: 'POST',
        async: true,
        success: function(answer){
            arr = createArrayFromString(answer);
            setClientList(arr);
        },
        error: function(answer){
            console.log('Ошибка получения списка клиентов. # '+answer);
        }
    });
}


function getAddressList(){
    $.ajax({
        url: '/transportlogistics/default/get-address-list',
        type: 'POST',
        async: true,
        success: function(answer){
            arr = createArrayFromString(answer);
            setAddressList(arr);
        },
        error: function(answer){
            console.log('Ошибка получения списка адресов. # '+answer);
        }
    });
}

function setClientList(arr){
    client_list = arr;
}

function setAddressList(arr){
    address_list = arr;
}


$(window).resize(function(){
    resizeDeliveryList();
});

function resizeDeliveryList(){
    var body_height = $('body').height();
    var footer_height = $('.footer').height()+20;
    var nav_height = $('.navbar').height()+20;
    var deliveryNewRecordBox_height = $('.delivery__new-record-box').height()+20;
    var toolBarTop_height = $('.toolbar-top').height();
    var request_height =$('.request__panel').height();
    var newHeightDelivery = body_height-(footer_height+nav_height+deliveryNewRecordBox_height+toolBarTop_height + request_height) -100;

    /*
    console.log('bHeight ='+ body_height);
    console.log('fHeight ='+ footer_height);
    console.log('navHeight ='+ nav_height);
    console.log('deliveryNewRecordBox_height ='+ deliveryNewRecordBox_height);
    console.log('toolBarTop_height ='+ toolBarTop_height);
    console.log('newHeightDelivery = '+newHeightDelivery);
    */

    $('.delivery').height(newHeightDelivery);
    $('.delivery-list').height(newHeightDelivery);

    $('.request__table__tbody__driver').width($('.request__table__tbody__driver select').width());
}

//вернет объект - следующее поле ввода
function getNextInput(currentInput){
    return $(currentInput).parents('div').next('div').children('input');
}

function welcome(){
    console.log('=== Развозки ===');
}