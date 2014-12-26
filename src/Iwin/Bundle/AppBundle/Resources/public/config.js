(function () {
    'use strict';

    requirejs.config({
        'waitSeconds': 20,
        'urlArgs':     'bust=' + window.$assets_version,
        shim:          {
            'facebook': {
                exports: 'FB'
            }
        },
        paths:         {
            'facebook': '//connect.facebook.net/en_US/all'
        }
    });
    requirejs([
        'jquery',
        'location',
        'domReady!'
    ], function ($, location, document) {
        $(document).ajaxSuccess(function (e, xhr, p, ret) {
            if (!p.crossDomain && xhr.responseJSON) {
                if (ret.__need_relogin) {
                    location.reload();
                }
            }
        });
        $(document).ready(function () {
            $(document).find('html').removeClass('no-js');
        });
    });
    requirejs([
        'prefixfree/prefixfree.min'
    ], function () {
        // do nothing
    });
}());