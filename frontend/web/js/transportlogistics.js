
//список клиентов
var client_list;


$(document).ready(function(){
    welcome();
    resizeDeliveryList();
    getClientList();

    $(document).on('focusout', '.delivery__new-record-box__date__input', function(){
        $(this).val(dateMask($(this).val()));
    });

    //автозаполнение
    /** клиент */
    $(document).on('input', '.delivery__new-record-box__client__input', function (event) {
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