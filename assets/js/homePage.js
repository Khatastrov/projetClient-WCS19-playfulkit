require('../scss/homePage.scss');


$('.one-time').slick({
    dots: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    autoplay: true,
    autoplaySpeed: 3000,
});

import Typed from 'typed.js';

var typed = new Typed(".type", {
    strings: ["easy !","fantastic !", "amazing !", "fun !"],
    typeSpeed: 100,
    backSpeed: 100,
    loop: true,
    smartBackspace: true // Default value
});
