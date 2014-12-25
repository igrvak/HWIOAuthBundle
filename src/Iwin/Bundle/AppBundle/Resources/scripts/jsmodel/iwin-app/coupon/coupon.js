define([
    'lodash',
    'backbone',
    'iwin-app/util/basemodel',
    './couponMultilang',
    './couponType',
    './couponTypeCollection',
], function (_, Backbone, BaseModel, CouponMultilang, CouponType, CouponTypeCollection) {
    'use strict';

    var langs = window.$langs;

    var Model = BaseModel.extend({
        "idAttribute": 'hash',

        "defaults": {
            "hash": null,
        },

        "initialize": function () {
            if (!this.get('multilang').length) {
                _.each(langs, function (i, el) {
                    this.get('multilang').add(new CouponMultilang({
                        "lang": el,
                    }));
                }, this);
            }
        },

        "relations": [
            {
                "type":         Backbone.HasMany,
                "key":          'multilang',
                "relatedModel": CouponMultilang
            }, {
                "type":              Backbone.HasOne,
                "key":               'type',
                "relatedCollection": CouponTypeCollection,
                "relatedModel":      CouponType,
            },
        ],
    });

    return Model;
});