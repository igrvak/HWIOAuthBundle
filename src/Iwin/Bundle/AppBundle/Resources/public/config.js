(function () {
    'use strict';

    requirejs.config({
        'waitSeconds': 20,
        'urlArgs':     'bust=' + window.$assets_version,
        shim:          {
            'facebook-api': {
                exports: 'FB'
            },
            'linkedin-api': {
                exports: 'IN'
            }
        },
        paths:         {
            'facebook-api': '//connect.facebook.net/en_US/all',
            'linkedin-api': '//platform.linkedin.com/in.js?async=true'
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