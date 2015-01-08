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
    (function () {
        var body = $('body'),
            loginPopup = $('#login-popup'),
            popupClose = loginPopup.find('.close-popup'),
            loginLink = $('#header').find('a.account');
        if (!loginLink.hasClass('authorized')) {
            var popupToggle = function (link) {
                link.on('click', function (e) {
                    e.preventDefault(e);
                    loginPopup.toggleClass('popup-active');
                    if (loginPopup.hasClass('popup-active')) {
                        body.addClass('lock');
                    } else {
                        body.removeClass('lock');
                    }
                })
            };
            popupToggle(popupClose);
            popupToggle(loginLink);
        }
    })();

    //sign in form
    var signInForm = $('#login-form'),
        signInButton = signInForm.find('button[type="submit"]');

    signInButton.click(function (e) {
        e.preventDefault();
        $.ajax(
            signInForm.attr('action'),
            {
                type: 'post',
                data: signInForm.serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        location.reload();
                    } else {
                        //TODO: handle message
                        window.alert(data.message);
                    }
                }
            }
        )
    });

    var showPass = signInForm.find('.link-show'),
        passField = signInForm.find('input[name="_password"]');
    showPass.mousedown(function (e) {
        e.preventDefault();
        passField.attr('type', 'text')
    });
    showPass.mouseup(function (e) {
        e.preventDefault();
        passField.attr('type', 'password')
    });
});
