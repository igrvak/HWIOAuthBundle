define([
    'lodash',
    'backbone',
    'templating',
    'iwin-app/images/galleryView',
    'iwin-app/videos/videosView',
    'iwin-app/coupon/couponsView',
    'iwin-app/profile/profileView',
    'jquery/openclose',
], function (_, Backbone, templating, ImagesView, VideosView, CouponsView, ProfileView) {
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
        "viewProfile": null,

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
            this.viewProfile= new ProfileView({
                "model": this.model.get('profile'),
            });
        },

        "events": {
            "click .advert-save": 'saveModel',
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

            this.viewProfile.setElement(this.$el.find('.profile-container'));
            this.viewProfile.render();

            this.$el.find('div.open-close').openClose({
                activeClass: 'active',
                opener:      '.opener',
                slider:      '.slide',
                animSpeed:   400,
                effect:      'slide',
            });

            return this;
        },

        "saveModel": function () {
            this.model.save();
        },
    });

    return View;
});