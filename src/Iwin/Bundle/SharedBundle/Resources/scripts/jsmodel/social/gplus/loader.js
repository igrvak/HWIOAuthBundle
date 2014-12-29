define([
    'module'
], function (module) {
    'use strict';

    // TODO: multiple callbacks
    // TODO: multiple loads

    var onLoadListener;

    var id = '__gapi_' + Math.random();
    window[id] = function () {
        gapi.client.load('plus', 'v1', function () {
            onLoadListener(window.gapi);
        });
    };

    return {
        load: function (name, req, onLoad) {
            onLoadListener = onLoad;
            requirejs([
                'async!https://apis.google.com/js/client:platform.js?onload=' + id
            ], function () {

            });
        }
    };
});