define([
    'lodash',
    'backbone',
    'routing',
    './category',
], function (_, Backbone, Routing, CategoryModel) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": CategoryModel,

        "url": Routing.generate('iwin_shared_category_root'),
    });

    return Collection;
});