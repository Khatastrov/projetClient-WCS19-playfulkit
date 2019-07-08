/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');
require('bootstrap');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

//images
require('../images/logo-officiel.png');
require('../images/logo-header.png');
require('../images/logo-officielR.png');
require('../images/robotDefault.png');
require('../images/board.jpg');
require('../images/electricity.jpg');
require('../images/form.png');
require('../images/profil.jpg');
require('../images/pass.jpg');

//avatars
function importAll(r){
    r.keys().forEach(r);
}
importAll(require.context('../images/avatars', true,/\.png$/));
importAll(require.context('../images/shop', true,/\.png$/));
importAll(require.context('../images/visuels home', true,/\.png$/));
//logos
require('../images/pfk-ico16.png');
require('../images/pfk-ico32.png');
require('../images/pfk-ico64.png');
require('../images/pfk-ico96.png');
require('slick-carousel');
