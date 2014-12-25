requirejs([
    'jquery',
    'underscore',
    'iwin-advert/advertModel',
    'iwin-advert/advertView',
    'json!/advertapi/__testadvert__',
    'jquery/openclose',
    'css!config/inner-tabs',
    'domReady!',
], function ($, _, AdvertModel, AdvertView, advertData) {
    'use strict';

    var cont = $('#page_target');

    cont.find('div.open-close').openClose({
        activeClass: 'active',
        opener:      '.opener',
        slider:      '.slide',
        animSpeed:   400,
        effect:      'slide',
    });

    var view = new AdvertView({
        'model': new AdvertModel(advertData),

        'el': cont.find('.advertmodel-container'),
    });
    console.log(view);
    view.render();
});