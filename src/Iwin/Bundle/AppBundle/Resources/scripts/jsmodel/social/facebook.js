define([
    'facebook-api',
    'backbone'
], function (FB, Backbone) {
    'use strict';

    FB.init({
        appId: '774836025885842', //TODO: bidlokod
    });


    var Model = Backbone.Model.extend({
        isLogged: function (ifTrue, ifFalse) {
            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    ifTrue();
                }
                else {
                    ifFalse();
                }
            });
        },
        login:    function (ifSuccess, ifFail) {
            FB.login(function (response) {
                if (response.status === 'connected') {
                    ifSuccess();
                }
                else {
                    ifFail();
                }
            }, {
                scope: 'user_about_me'
            });

        },
        getData:  function (callback) {
            FB.api('/me', function (response) {
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

    var Facebook = new Model({});

    return Facebook;
});