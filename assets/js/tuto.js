require('../scss/tuto.scss');

$('.customCollapse').first('article').attr('id', 'firstCollapse');
$('.customCollapse button').css("background-color", "rgb(142, 191, 107)");
$('#firstCollapse article').slideDown(400);
$('#firstCollapse button').css("background-color", "rgb(217, 24, 24)");
$('#firstCollapse button').addClass('isOpen').text('-');

$('.customCollapse button').on('click', function(){
    if ($(this).hasClass('isOpen')){
        $('.customCollapse article').stop();
        $(this).parent('.row').siblings('article').slideUp(400);
        $(this).removeClass('isOpen').text('+');
        $(this).css("background-color", "rgb(142, 191, 107)");
    }

    else{
        $('.customCollapse article').stop();
        $(this).parent('.row').siblings('article').slideDown(400);
        $(this).addClass('isOpen').text('-');
        $(this).css("background-color", "rgb(217, 24, 24)");
    }
});