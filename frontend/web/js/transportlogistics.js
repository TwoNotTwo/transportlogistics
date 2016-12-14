
//список клиентов
var client_list;

//список адресо
var address_list;


$(document).ready(function(){
    welcome();
    resizeDeliveryList();
    getClientList();
    getAddressList();

    $(document).on('focusout', '.delivery__new-record-box__date__input', function(){
        $(this).val(dateMask($(this).val()));
    });

    //автозаполнение
    /** клиент */
    $(document).on('input', '.field-transportlogisticsclient-clientname input', function (event) {
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
    $(document).on('input', '.field-transportlogisticsaddress-address input', function (event) {
        if (event.keyCode != KEY_TAB && event.keyCode != KEY_SHIFT) {

            $(this).ludwig_autocomplete({
                list: address_list,
                minChar: 2,
                displayList: true
                //capitalLetter: true
            }, event);
        }
    });
    /** адрес */



    /** отслеживание момента заполнения input через autocomplete */


    $(document).bind('clickOnListItem', function (event) {
        setAttrFromDropDownListItem();
    });

    /** отслеживание момента заполнения input через autocomplete */
    $(document).bind('autocompleteDone', function (event, input) {
        removeIdActiveInput();
        removeDropDownList();
    });

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
    var body_height = $('body').height();
    var deliveryList = $('.delivery');
    var footer_height = $('.footer').height();
    var x= 250;
   // if ($('.delivery__new-record-box').length > 0) x = 250;
    var deliveryList_height = body_height-footer_height-x;

    $(deliveryList).height(deliveryList_height);
}

function welcome(){
    console.log('=== развозки ===');
}