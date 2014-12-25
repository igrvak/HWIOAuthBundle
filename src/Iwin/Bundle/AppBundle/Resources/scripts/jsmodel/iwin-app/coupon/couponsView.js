define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'iwin-app/util/collectionView',
    'iwin-app/coupon/coupon',
    'select2/select2',
], function ($, _, Backbone, templating, CollectionView, CouponModel) {
    'use strict';

    var viewId = 'iwin-app-coupon-coupon';

    var View = CollectionView.extend({
        "relatedModel": CouponModel,

        "template": templating.get(viewId),

        "initialize": function () {
            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);
        },

        "render": function () {
            this.$el.find('.select2').select2('destroy');

            this.$el.html(this.template(this.model));

            this.$el.find('.select2').select2({
                "minimumResultsForSearch": -1,
                "containerCssClass":       function () {
                    return $(this).attr('class');
                },
            });

            return this;
        },
    });

    return View;
});