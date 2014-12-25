define([
    'lodash',
    'twig',
    'translator',
    'assets',
    'routing',
], function (_, Twig, Translator, assets, Routing) {
    'use strict';

    Twig.extendFunction('asset', function (val) {
        return assets.asset(val);
    });

    Twig.extendFilter('trans', function (val, options) {
        options.unshift(val);
        return Translator.trans.apply(Translator, options);
    });

    Twig.extendFunction('path', function () {
        var args = Array.prototype.slice.call(arguments, 0);
        _.each(args, function (arg) {
            if (_.isObject(arg)) {
                delete arg._keys;
            }
        });
        return Routing.generate.apply(Routing, args);
    });

    return Twig;
});