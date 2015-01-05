define([
    'lodash',
    'backbone',
    'routing',
    './categoryLink',
], function (_, Backbone, Routing, CategoryLinkModel) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": CategoryLinkModel,
    });

    return Collection;
});