/**
 * Назвал advertModel, т.к. adBlock блокировал advert.js
 */
define([
    'backbone',
    'iwin-app/util/basemodel',
    'iwin-app/coupon/coupon',
    'iwin-app/coupon/couponCollection',
    './gallery',
], function (Backbone, BaseModel, Coupon, CouponCollection, GalleryModel) {
    'use strict';

    var Model = BaseModel.extend({
        "idAttribute": 'hash',

        "defaults": {
            "hash": null,
        },

        "relations": [
            {
                "type":              Backbone.HasMany,
                "key":               'coupons',
                "relatedModel":      Coupon,
                "relatedCollection": CouponCollection,
            }, {
                "type":         Backbone.HasOne,
                "key":          'gallery',
                "relatedModel": GalleryModel,
            },
        ],
    });

    return Model;
});