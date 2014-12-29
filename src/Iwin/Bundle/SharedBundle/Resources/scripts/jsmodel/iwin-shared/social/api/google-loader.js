define([
    'module',
],function (module) {
    'use strict';

    var config = module.config();

    // @formatter:off
    function injectScript(src){
        var s, t;
        s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = src;
        t = document.getElementsByTagName('script')[0]; t.parentNode.insertBefore(s,t);
    }
    // @formatter:on

    var gapi;

    return {
        load: function (name, req, onLoad) {
            var id = '__gapi_' + Math.random();
            window[id] = function () {
                gapi = window.gapi;
                gapi.client.setApiKey(config.oauthid);
                gapi.client.load('plus', 'v1', function () {
                    onLoad(gapi);
                });
            };

            injectScript('//apis.google.com/js/client:plus.js?onload=' + id);
        }
    };
});