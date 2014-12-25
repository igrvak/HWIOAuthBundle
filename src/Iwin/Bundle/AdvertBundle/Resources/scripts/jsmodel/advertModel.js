/**
 * Назвал advertModel, т.к. adBlock блокировал advert.js
 */
define([
    'backbone',
    'iwin-app/util/basemodel',
    'iwin-app/coupon/couponCollection',
    './gallery',
], function (Backbone, BaseModel, CouponCollection, GalleryModel) {
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
                "relatedModel":      CouponCollection.model,
                "relatedColelction": CouponCollection,
            }, {
                "type":         Backbone.HasOne,
                "key":          'gallery',
                "relatedModel": GalleryModel,
            },
        ],
    });

    return Model;
});