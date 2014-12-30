define([
    'lodash',
    'backbone',
    'templating',
    'iwin-shared/images/galleryView',
    'iwin-shared/videos/videosView',
    'iwin-app/profile/profileView',
    'iwin-shared/location/routeView',
    'iwin-shared/category/categoryView',
    'jquery/openclose',
], function (_, Backbone, templating, ImagesView, VideosView, ProfileView, RouteView, CategoryView) {
    'use strict';

    var viewId = 'iwin-qual-task';

    var View = Backbone.View.extend({
        "views":    {},
        "template": templating.get(viewId),

        "initialize": function () {
            this.initializeViews();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);
        },

        "initializeViews": function () {
            this.views = {
                "gallery": new ImagesView({
                    "model": this.model.get('gallery.images'),
                }),
                "videos":  new VideosView({
                    "model": this.model.get('gallery.videos'),
                }),
                "profile": new ProfileView({
                    "model": this.model.get('profile'),
                }),
                "route":   new RouteView({
                    "model": this.model.get('locations'),
                }),
                "category": new CategoryView({
                    "model": this.model.get('category'),
                }),
            };
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