define([
    'lodash',
    'backbone',
    'util/basemodel',
    './couponMultilang',
    './couponType',
    './couponDiscount',
], function (_, Backbone, BaseModel, CouponMultilang, CouponType, CouponDiscount) {
    'use strict';

    var langs = window.$langs;

    var Model = BaseModel.extend({
        "initialize": function () {
            if (!this.get('multilang').length) {
                _.each(langs, function (i, el) {
                    this.get('multilang').add(new CouponMultilang({
                        "lang": el,
                    }));
                }, this);
            }
            if (!this.get('discount')) {
                this.set('discount', new CouponDiscount());
            }
        },

        "relations": [
            {
                "type":         Backbone.HasMany,
                "key":          'multilang',
                "relatedModel": CouponMultilang
            }, {
                "type":         Backbone.HasOne,
                "key":          'type',
                "relatedModel": CouponType,
            }, {
                "type":         Backbone.HasOne,
                "key":          'discount',
                "relatedModel": CouponDiscount,
            },
        ],
    });

    return Model;
});