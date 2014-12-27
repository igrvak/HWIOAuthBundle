define([
    'backbone',
    'iwin-shared/social/userSocial',
    'iwin-shared/social/social',
    'iwin-shared/social/socialCollection',
], function (Backbone, UserSocial) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model":      UserSocial,
    });
    return Collection;
});