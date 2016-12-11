$(document).ready(function(){
    welcome();
    resizeDeliveryList();


    $(document).on('focusout', '.delivery__new-record-box__date__input', function(){
        $(this).val(dateMask($(this).val()));
    })
});


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