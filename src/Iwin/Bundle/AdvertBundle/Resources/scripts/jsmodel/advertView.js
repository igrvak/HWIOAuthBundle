define([
    'lodash',
    'backbone',
    'templating',
    'iwin-shared/images/galleryView',
    'iwin-shared/videos/videosView',
    'iwin-shared/coupon/couponsView',
    'iwin-app/profile/profileView',
    'iwin-shared/category/categoryView',
    'jquery/openclose',
], function (_, Backbone, templating, ImagesView, VideosView, CouponsView, ProfileView, CategoryView) {
    'use strict';

    var viewId = 'iwin-advert-advert';

    var View = Backbone.View.extend({
        "template": templating.get(viewId),
        "views":    {},

        "initialize": function () {
            this.views = {
                "gallery":  new ImagesView({
                    "model": this.model.get('gallery.images'),
                }),
                "videos":   new VideosView({
                    "model": this.model.get('gallery.videos'),
                }),
                "coupon":   new CouponsView({
                    "model": this.model.get('coupons'),
                }),
                "profile":  new ProfileView({
                    "model": this.model.get('profile'),
                }),
                "category": new CategoryView({
                    "model": this.model.get('category'),
                }),
            };

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);
        },

        "events": {
            "click .advert-save": 'saveModel',
        },

        "render": function () {
            _.each(this.views, function (view) {
                view.remove();
            });

            this.$el.html(this.template(this.model));

            _.each(this.views, function (view, name) {
                view.setElement(this.$el.find('.' + name + '-container'));
                view.render();
            }, this);

            this.$el.find('.benefits div.open-close').openClose({
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