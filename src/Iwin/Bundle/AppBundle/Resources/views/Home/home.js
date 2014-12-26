requirejs([
    'jquery',
    'underscore',
    'iwin-app/createfree/view',
    'domReady!',
], function ($, _, CreateFreeView) {
    'use strict';

    var cont = $('#page_target');

    var view = new CreateFreeView({
        'el': cont,
    });
    view.render();
});