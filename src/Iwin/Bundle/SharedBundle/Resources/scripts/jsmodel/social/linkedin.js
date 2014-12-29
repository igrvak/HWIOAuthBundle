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
            //IN.UI.WidgetSignin();
            $('.heading').html('<script type="in/Login"> Hello, <?js= firstName ?> <?js= lastName ?>. </script>');

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
                console.log({
                    id:     response.values[0].id,
                    name:   response.values[0].firstName + ' ' + response.values[0].lastName,
                    gender: '',
                    link:   '',
                    photo:  ''
                });
            });
        }
    });

    var LindkedIn = new Model({});

    return LindkedIn;
});