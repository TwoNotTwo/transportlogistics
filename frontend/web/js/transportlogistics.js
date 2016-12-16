
//список клиентов
var client_list;

//список адресо
var address_list;


$(document).ready(function(){
    welcome();
    resizeDeliveryList();
    getClientList();
    getAddressList();

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
        //console.log('autocompleteDone. input = '+input.attr('class'));
        removeIdActiveInput();
        removeDropDownList();
    });

});



    $('.form-control').on('keydown', function(event){
        if (event.keyCode == KEY_ENTER && !usingList()){
            console.log('enter is pressed');
            /*nextInput = */getNextInput($(this)).focus();
         //   console.log('autocompleteDone. nextInput = '+nextInput.attr('class'));

        }
    });


function getClientList(){
    $.ajax({
        url: '/transportlogistics/default/get-client-list',
        type: 'POST',
        async: false,
        success: function(answer){
            arr = createArrayFromString(answer);
            setClientList(arr);
        },
        error: function(answer){
            console.log('Ошибка получения списка клиентов. # '+answer);
        }
    });
}

function setClientList(arr){
    client_list = arr;
}

function getAddressList(){
    $.ajax({
        url: '/transportlogistics/default/get-address-list',
        type: 'POST',
        async: false,
        success: function(answer){
            arr = createArrayFromString(answer);
            setAddressList(arr);
        },
        error: function(answer){
            console.log('Ошибка получения списка адресов. # '+answer);
        }
    });
}

function setAddressList(arr){
    address_list = arr;
}



$(window).resize(function(){
    resizeDeliveryList();
});

function resizeDeliveryList(){
    /**
     * высчитыывай подходящую высоту для элемента, исходя из общей
     * высоты окна и тех элементов, которые уже есть на странице
     *
     *
     */

    var body_height = $('body').height();
    var deliveryList = $('.delivery'); //573
    var footer_height = $('.footer').height();
    var x= 120+$('.delivery__new-record-box').height();
    console.log('x= '+x);
   // if ($('.delivery__new-record-box').length > 0) x = 250;
    var deliveryList_height = body_height-footer_height-x;

    $(deliveryList).height(deliveryList_height);

    $('.delivery-list').css('max-height', x);//deliveryList_height - 82); //643
}

//вернет объект - следующее поле ввода
function getNextInput(currentInput){
    //console.log('next input');
    var nextInput = $(currentInput).parents('div').next('div').children('input');
    //nextInput = (nextInput.hasAttr('class')) ? nextInput : $(currentInput).parents('tr').next('tr').children('td').find('input').first();

    return nextInput;
}

function welcome(){
    console.log('=== развозки ===');
}