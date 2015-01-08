define([
    'lodash',
    'backbone',
    './categoriesView',
    './categoryCollection',
], function (_, Backbone, CategoriesView, CategoryCollection) {
    'use strict';

    var View = CategoriesView.extend({
        "initialize": function () {
            this.isMultiple = false;
            this.model = new CategoryCollection([
                this.model,
            ]);

            CategoriesView.prototype.initialize.apply(this, arguments);
        },
    });

    return View;
});