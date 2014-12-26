define([
    'jquery',
    'linkedin-api'
], function ($, IN) {
    'use strict';

    IN.init({
        api_key: '75l9jttrjuc4a2'
    });

    var Model = Backbone.Model.extend({
        isLogged: function (ifTrue, ifFalse) {
            if (IN.User.isAuthorized()) {
                ifTrue();
            }
            else {
                ifFalse();
            }
        },
        login:    function (ifSuccess, ifFail) {
            IN.UI.WidgetSignin();
            //FB.login(function (response) {
            //    if (response.status === 'connected') {
            //        ifSuccess();
            //    }
            //    else {
            //        ifFail();
            //    }
            //}, {
            //    scope: 'user_about_me'
            //});

        },
        getData:  function (callback) {
            IN.API.Profile('me').result(function (response) {
                callback({
                    id:     response.id,
                    name:   response.name,
                    gender: response.gender,
                    link:   response.link,
                    photo:  ''
                });
            });
        }
    });

    var LindkedIn = new Model({});

    return LindkedIn;
});