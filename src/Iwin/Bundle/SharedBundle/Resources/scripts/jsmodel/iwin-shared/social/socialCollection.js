define([
    'lodash',
    'backbone',
    'routing',
    'iwin-shared/social/social',
], function (_, Backbone, Routing, Social) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": Social,
        "url":   Routing.generate('iwin_social_list')
    });

    return Collection;
});