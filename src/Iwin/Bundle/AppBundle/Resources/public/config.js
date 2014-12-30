(function () {
    'use strict';

    requirejs.config({
        'waitSeconds': 20,
        'urlArgs':     'bust=' + window.$assets_version,

        "map":    {
            "*":           {
                "select2/select2": "config/select2/select2",
                "fancybox":        "config/fancybox",
                "twig":            "config/twig",
            },
            "config/twig": {
                "twig": "twig",
            },
        },
        "config": {
            "social/manager":      {
                "list":[
                    'gplus', 'facebook', 'linkedin',
                ],
            },
            "social/api/google-loader":   window.$socials.gplus,
            "social/api/facebook-loader": {
                appId: window.$socials.facebook,
            },
            "social/api/linkedin-loader": {
                api_key: window.$socials.linkedin,
            },
        },
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