define([
    'facebook-api'
], function (FB) {
    'use strict';

    FB.init({
        appId: '774836025885842', //TODO: bidlokod
    });

    return FB;
});