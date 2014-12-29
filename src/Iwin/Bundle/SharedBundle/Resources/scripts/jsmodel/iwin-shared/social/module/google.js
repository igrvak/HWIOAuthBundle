define([
    'backbone',
    'iwin-shared/social/api/google',
], function (Backbone, gapi) {
    'use strict';

    var GPLUS = Backbone.Model.extend({
        isLogged: function (ifTrue, ifFalse) {
            if (gapi.auth.getToken().status.google_logged_in === true) {
                ifTrue();
            }
            else {
                ifFalse();
            }
        },
        login:    function (ifSuccess, ifFail) {
            gapi.auth.signIn({
                'clientid':       window.$webapp.var.socials.gplus.apikey,
                'cookiepolicy':   'single_host_origin',
                'callback':       function (a) {
                    ifSuccess(a);
                },
                'approvalprompt': 'force',
                'scope':          'https://www.googleapis.com/auth/plus.me'
            });

        },
        getData:  function (callback) {
            gapi.client.plus.people.get({
                'userId': 'me'
            }).execute(function (response) {
                callback({
                    id:     response.id,
                    name:   response.displayName,
                    gender: response.gender,
                    link:   response.url,
                    photo:  response.image.url
                });
            });
        }
    });


    return GPLUS;
});