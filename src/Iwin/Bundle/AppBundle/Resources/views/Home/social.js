requirejs([
    'jquery',
    'underscore',
    'backbone',
    'social/facebook',
    'social/linkedin'
], function ($, _, Backbone, facebook, linkedin) {
    'use strict';
    //
    console.log(linkedin);


    $('#facebook').on('click', function (event) {
        event.preventDefault();
        facebook.login(function () {
            facebook.getData(function (a) {
                $('#facebook').text('IS READY, ' + a.name + '!');
            });

        });
    });

    $('#linkedin').on('click', function (event) {
        event.preventDefault();
        linkedin.login(function () {
            linkedin.getData(function (a) {
                $('#linkedin').text('IS READY, ' + a.name + '!');
            });
        });
    });

    //
    //console.log(hello);
    //
    //hello.init({
    //    twitter:  'FbZDGmk9kvfwY3yxsLopIfOfE',
    //    google:   '162631910090-igsi864ajqpp1k3k4kl5lfftcrdfsct0.apps.googleusercontent.com',
    //    linkedin: '75l9jttrjuc4a2',
    //    facebook: '774836025885842'
    //}, {redirect_uri: '/'});
    //
    //
    //$('#twitter').on('click', function (event) {
    //    event.preventDefault();
    //    hello.login('twitter');
    //});
    //
    //$('#g').on('click', function (event) {
    //    event.preventDefault();
    //    hello.login('google');
    //});
    //
    //$('#linkedin').on('click', function (event) {
    //    event.preventDefault();
    //    hello.login('linkedin');
    //});
    //
    //$('#facebook').on('click', function (event) {
    //    event.preventDefault();
    //    hello.login('facebook');
//});

//hello.on('auth.login', function (r) {
//    // Get Profile
//    hello.api(r.network + ':/me', function (p) {
//        console.log(p);
//    });
//});
//
//
//hello.init({
//    twitter:  '9xPg0TbmOIU3uLpUs6piWGhCF',
//    facebook: '774836025885842',
//    linkedin: '75l9jttrjuc4a2'
//}, {
//    redirect_uri: '/',
//});
//
//hello.login('twitter');

//
//(function login(network) {
//    // Twitter instance
//    var twitter = hello(network);
//    // Login
//    twitter.login().then(function (r) {
//        // Get Profile
//        return twitter.api('me');
//    })
//        .then(function (p) {
//            // Put in page
//            console.log(p);
//        });
//})('twitter');
//
//hello.init({
//        'twitter': '9xPg0TbmOIU3uLpUs6piWGhCF'
//    },
//    {
//        redirect_uri: document.URL
//    });


//setTimeout(function () {
//    gapi.client.plus.people.get({
//        'userId': 'me'
//    }).then(function (res) {
//        var profile = res.result;
//        console.log(profile);
//    });
//}, 3000);

//
//console.log(IN);

//IN.API.Profile("me").result(function (data) {
//    console.log(data);
//});
//
//
//
//
//FB.getLoginStatus(function (response) {
//    if (response.status === 'connected') {
//        FB.api(
//            "/me",
//            {
//                access_token: response.authResponse.accessToken
//            },
//            function (response) {
//                if (response && !response.error) {
//                    console.log('facebook', response);
//                }
//            }
//        );
//        console.log('Logged in.');
//    }
//    else {
//        FB.login(function () {
//        }, {
//            scope: 'user_about_me'
//        });
//    }
//});


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