define([
    'lodash',
    'backbone',
    'routing',
    'iwin-shared/social/social',
], function (_, Backbone, Routing, Social) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": Social,
        "url":   Routing.generate('socials-list')
    });

    return Collection;
});