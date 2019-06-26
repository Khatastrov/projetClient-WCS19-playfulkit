require('../scss/user.scss');

$('#btn1').addClass('color');

$('#btn1').on('click', function(){
    $('#btn2').removeClass('color');
    $('#btn3').removeClass('color');
    $('#btn1').addClass('color');
});

$('#btn2').on('click', function(){
    $('#btn1').removeClass('color');
    $('#btn3').removeClass('color');
    $('#btn2').addClass('color');
});

$('#btn3').on('click', function(){
    $('#btn1').removeClass('color');
    $('#btn2').removeClass('color');
    $('#btn3').addClass('color');
});
