define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    './coupon',
    './couponEditView',
], function ($, _, Backbone, templating, CollectionView, CouponModel, CouponEditView) {
    'use strict';

    var viewId = 'iwin-shared-coupon-coupons';

    var View = CollectionView.extend({
        "couponEditing": false,
        "couponView":    null,
        "relatedModel":  CouponModel,

        "template": templating.get(viewId),

        "initialize": function () {
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);
        },

        "events": {
            "click .btn-add":    'createCoupon',
            "click .btn-cancel": 'createCancel',
            "click .btn-save":   'editSave',
        },

        "render": function () {
            this.$el.html(this.template(this.model, {
                "couponEditing": this.couponEditing,
            }));

            if (this.couponEditing) {
                this.couponView.setElement(this.$el.find('.coupon-holder'));
                this.couponView.render();
            } else {
                $(".coupon-carousel").owlCarousel({
                    items: "1",
                    nav: true
                });
            }

            this.delegateEvents();

            return this;
        },

        "editSave":function(e){
            e.preventDefault();

            if (!this.couponView) {
                throw 'Wrong view';
            }

            this.couponView.remove();
            this.couponView = null;

            this.couponEditing = false;

            this.render();
        },

        "createCoupon": function (e) {
            e.preventDefault();

            var model = new CouponModel();
            this.model.get('list').add(model);

            if (this.couponView) {
                throw 'Wrong view';
            }

            this.couponView = new CouponEditView({
                "model": model,
            });

            this.couponEditing = true;

            this.render();
        },
        "createCancel": function (e) {
            e.preventDefault();

            if (!this.couponView) {
                throw 'Wrong view';
            }

            var model = this.couponView.model;
            this.model.get('list').remove(model);

            this.couponView.remove();
            this.couponView = null;

            this.couponEditing = false;

            this.render();
        },
    });

    return View;
});