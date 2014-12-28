define([
    'lodash',
    'backbone',
    './categoriesView',
    './categoryCollection',
], function (_, Backbone, CategoriesView, CategoryCollection) {
    'use strict';

    var View = CategoriesView.extend({
        "initialize": function () {
            var args = _.toArray(arguments),
                options = args.shift();

            if (options.model) {
                options.model = new CategoryCollection([
                    options.model,
                ]);
            }
            options.isMultiple = false;
            args.unshift(options);

            CategoriesView.prototype.initialize.apply(this, args);
        },
    });

    return View;
});