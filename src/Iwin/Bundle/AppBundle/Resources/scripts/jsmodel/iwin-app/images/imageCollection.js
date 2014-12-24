define([
    'lodash',
    'backbone',
    './image',
], function (_, Backbone, ImageModel) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": ImageModel,
    });

    return Collection;
});