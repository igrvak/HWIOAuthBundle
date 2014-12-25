requirejs([
    'jquery',
    'domReady!',
], function ($) {
    'use strict';

    $('a[href="#user_profile"], a[href="#need_help"], a[href="#send_invite"]').click(function (e) {
        e.preventDefault();
        window.alert('Todo: не готово');
    });
});