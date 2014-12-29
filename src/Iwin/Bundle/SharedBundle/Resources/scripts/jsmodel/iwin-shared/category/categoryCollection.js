define([
    'lodash',
    'backbone',
    './category',
], function (_, Backbone, CategoryModel) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": CategoryModel,
    });

    return Collection;
});