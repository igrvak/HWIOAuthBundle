define([
    'jquery',
    'lodash',
    'twig',
    'domReady!',
], function ($, _, Twig) {
    'use strict';

    var cont = $('#global_page_templates');

    cont.find('script[type="text/x-twig-template"]').each(function () {
        Twig.twig({
            'id':   $(this).data('id'),
            'data': $(this).html(),

            'allowInlineIncludes': true,
        });
    });

    var templating = {
        "twig":      Twig,
        "render":    function () {
            var args = _.toArray(arguments),
                name = args.shift();
            return this.get(name).apply(this, args);
        },
        "findBlock": function (name) {
            return Twig.twig({
                'ref': name,
            });
        },
        "get":       function (name, contextGlobal) {
            var tpl = this.findBlock(name);
            if (!tpl) {
                throw 'Template not found: ' + name;
            }
            return _.bind(function (contextIn, params) {
                var context = _.merge({}, contextGlobal, contextIn);
                return tpl.render.call(tpl, context, params);
            }, this);
        },
    };

    return templating;
});