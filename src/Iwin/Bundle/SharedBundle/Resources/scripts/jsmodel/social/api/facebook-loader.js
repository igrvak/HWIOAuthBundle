define([
    'module',
], function (module) {
    'use strict';

    var config = module.config();

    // @formatter:off
    function injectScript(src, onLoad){
        var s, t;
        s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = src;
        s.onload = onLoad;
        t = document.getElementsByTagName('script')[0]; t.parentNode.insertBefore(s,t);
    }
    // @formatter:on

    return {
        load: function (name, req, onLoad) {
            injectScript('//connect.facebook.net/en_US/all.js', function(){
                var FB = window.FB;

                FB.init({
                    appId: config.appId,
                });

                onLoad(FB);
            });
        }
    };
});