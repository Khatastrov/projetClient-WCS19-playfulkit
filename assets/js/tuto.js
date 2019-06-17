require('../scss/tuto.scss');

console.log('Ok tuto !');

$('.customCollapse button').on('click', function(){
    if ($(this).hasClass('isOpen')){
        $('.customCollapse article').stop();
        $(this).siblings('article').slideUp(400);
        $(this).removeClass('isOpen').text('+');
    }

    else{
        $('.customCollapse article').stop();
        $(this).siblings('article').slideDown(400);
        $(this).addClass('isOpen').text('-');
    }
});