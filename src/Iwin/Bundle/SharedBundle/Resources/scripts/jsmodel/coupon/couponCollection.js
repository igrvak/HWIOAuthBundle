define([
    'lodash',
    'backbone',
    './coupon',
], function (_, Backbone, CouponModel) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": CouponModel,
    });

    return Collection;
});