define(function () {
    'use strict';

    return {
        'asset': function (path) {
            return '/' + path + '?bust=' + window.$assets_version;
        },
    };
});