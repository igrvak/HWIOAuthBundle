define([
    'lodash',
    'backbone',
    './location',
], function (_, Backbone, LocationModel) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": LocationModel,
    });

    return Collection;
});