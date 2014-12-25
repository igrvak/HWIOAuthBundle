define([
    'backbone',
    'iwin-app/util/basemodel',
    './couponMultilang',
], function (Backbone, BaseModel, CouponMultilang) {
    'use strict';

    var Model = BaseModel.extend({
        "idAttribute": 'hash',

        "defaults": {
            "hash": null,
        },

        "relations": [{
            "type":         Backbone.HasMany,
            "key":          'multilang',
            "relatedModel": CouponMultilang
        }],
    });

    return Model;
});