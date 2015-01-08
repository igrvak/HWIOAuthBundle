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
        "defaults": {
            "isCreated": false,
        },

        "initialize": function () {
            if (!this.get('translations').length) {
                _.each(langs, function (i, el) {
                    this.get('translations').add(new CouponMultilang({
                        "locale": el,
                    }));
                }, this);
            }
            if (!this.get('discount')) {
                this.set('discount', new CouponDiscount());
            }

            if (this.id) {
                this.set('isCreated', true);
            }
        },

        "relations": [
            {
                "type":         Backbone.HasMany,
                "key":          'translations',
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