/**
 * Назвал advertModel, т.к. adBlock блокировал advert.js
 */
define([
    'backbone',
    'routing',
    'iwin-app/util/basemodel',
    'iwin-app/coupon/coupon',
    'iwin-app/coupon/couponCollection',
    'iwin-app/gallery',
], function (Backbone, Routing, BaseModel, Coupon, CouponCollection, GalleryModel) {
    'use strict';

    var Model = BaseModel.extend({
        "url": Routing.generate('iwin_advert_save'),

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