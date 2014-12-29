define([
    'module',
    'facebook-api'
], function (module, FB) {
    'use strict';

    var config = module.config();


    return {
        load: function (name, req, onLoad) {

            FB.init({
                appId: config.appId,
            });

            onLoad(FB);
        }
    };
});