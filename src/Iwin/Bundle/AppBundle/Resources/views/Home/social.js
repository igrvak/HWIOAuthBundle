requirejs([
    'jquery',
    'underscore',
    'backbone',
    'facebook'
], function ($, _, Backbone, FB) {
    'use strict';


    FB.init({
        appId: '774836025885842',
    });
    FB.getLoginStatus(function (response) {
        if (response.status === 'connected') {
            FB.api(
                "/me",
                {
                    access_token: response.authResponse.accessToken
                },
                function (response) {
                    if (response && !response.error) {
                        console.log(response);
                    }
                }
            );
            console.log('Logged in.');
        }
        else {
            FB.login(function () {
            }, {
                scope: 'user_about_me'
            });
        }
    });


    //
    //var Model = Backbone.Model.extend({
    //    'class':   'twitter',
    //    'getData': function () {
    //        return 'some-data';
    //    }
    //});
    //
    //var twitter = new Model();

});