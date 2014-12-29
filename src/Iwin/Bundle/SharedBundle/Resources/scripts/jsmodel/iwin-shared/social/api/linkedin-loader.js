define([
    'module',
    'linkedin-api'
], function (module, IN) {
    'use strict';

    var config = module.config();


    return {
        load: function (name, req, onLoad) {
            IN.init({
                api_key: config.api_key
            });
            onLoad(IN);
        }
    };
});