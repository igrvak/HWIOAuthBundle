requirejs([
    'jquery',
    'domReady!',
], function ($) {
    'use strict';

    $('a[href="#need_help"], a[href="#send_invite"]').click(function (e) {
        e.preventDefault();
        window.alert('Todo: не готово');
    });

    //sign in pop up
    (function() {
        var body = $('body'),
            loginPopup = $('#login-popup'),
            popupClose = loginPopup.find('.close-popup'),
            loginLink = $('#header').find('a.account');

        function popupToggle(link) {
            link.on('click', function(e){
                e.preventDefault(e);
                loginPopup.toggleClass('popup-active');
                if (loginPopup.hasClass('popup-active')) {
                    body.addClass('lock');
                } else {body.removeClass('lock');}
            })
        }
        popupToggle(popupClose);
        popupToggle(loginLink);
    })()
});