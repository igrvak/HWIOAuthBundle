define([
    'lodash',
    'backbone',
    'routing',
    './couponType',
], function (_, Backbone, Routing, CouponType) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": CouponType,

        "url": Routing.generate('iwin_coupon_types'),
    });

    return Collection;
});