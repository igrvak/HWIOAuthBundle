define([
    'lodash',
    'backbone',
    'templating',
    'iwin-app/images/galleryView',
    'iwin-app/videos/videosView',
    'iwin-app/coupon/couponsView',
], function (_, Backbone, templating, ImagesView, VideosView, CouponsView) {
    'use strict';

    var viewId = 'iwin-advert-advert';

    var View = Backbone.View.extend({
        "template": templating.get(viewId),

        "initialize": function () {
            this.initializeViews();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);
        },

        "viewImages":  null,
        "viewVideos":  null,
        "viewCoupons": null,

        "initializeViews": function () {
            this.viewImages = new ImagesView({
                "model": this.model.get('gallery.images'),
            });
            this.viewVideos = new VideosView({
                "model": this.model.get('gallery.videos'),
            });
            this.viewCoupons = new CouponsView({
                "model": this.model.get('coupons'),
            });
        },

        "render": function () {
            this.viewImages.remove();
            this.viewVideos.remove();

            this.$el.html(this.template(this.model));

            this.viewImages.setElement(this.$el.find('.gallery-container'));
            this.viewImages.render();

            this.viewVideos.setElement(this.$el.find('.videos-container'));
            this.viewVideos.render();

            this.viewCoupons.setElement(this.$el.find('.coupon-holder'));
            this.viewCoupons.render();

            return this;
        },
    });

    return View;
});