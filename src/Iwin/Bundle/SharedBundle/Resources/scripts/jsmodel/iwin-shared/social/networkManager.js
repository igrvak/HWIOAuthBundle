define([
    'facebook-api',
    'google-api',
    'backbone'
], function (FB, gapi, Backbone) {
    'use strict';


    var google_client_id = '844288230442-72la5sqc6ahhbl355tpfhfphhc5n0sur.apps.googleusercontent.com';

    var scopes = 'https://www.googleapis.com/auth/plus.me';


    console.log(gapi);
    FB.init({
        appId: window.$webapp.var.socials.facebook, //TODO: bidlokod
    });

    var Facebook = Backbone.Model.extend({
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
                FB.api(
                    "/me/picture",
                    {
                        "redirect": false,
                        "height":   "200",
                        "type":     "normal",
                        "width":    "200"
                    },
                    function (picture) {
                        if (response && !response.error) {
                            callback({
                                id:     response.id,
                                name:   response.name,
                                gender: response.gender,
                                link:   response.link,
                                photo:  picture.data.url
                            });
                        }
                    }
                );

            });
        }
    });


    var Manager = Backbone.Model.extend({

        "initialize": function () {
            this.set('facebook', new Facebook());
        },
        "network":    function (key) {
            //console.log(this.get(key));
            return this.get(key);
        }
    });


    return new Manager();
});