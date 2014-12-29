(function () {
    'use strict';

    requirejs.config({
        'waitSeconds': 20,
        'urlArgs':     'bust=' + window.$assets_version,
        "paths":       {
            'linkedin-api': '//platform.linkedin.com/in.js?async=true',
            'facebook-api': '//connect.facebook.net/en_US/all'
        },

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
            "iwin-shared/social/api/google-loader":   window.$socials.gplus,
            "iwin-shared/social/api/facebook-loader": {
                appId: window.$socials.facebook
            },
            "iwin-shared/social/api/linkedin-loader": {
                api_key: '75l9jttrjuc4a2'
            }
        },
        "shim":   {
            'linkedin-api': {
                exports: 'IN',
            },
            'facebook-api': {
                exports: 'FB',
            }
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