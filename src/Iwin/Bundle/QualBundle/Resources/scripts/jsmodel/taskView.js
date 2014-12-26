define([
    'lodash',
    'backbone',
    'templating',
    'iwin-app/images/galleryView',
    'iwin-app/videos/videosView',
    'jquery/openclose',
], function (_, Backbone, templating, ImagesView, VideosView) {
    'use strict';

    var viewId = 'iwin-qual-task';

    var View = Backbone.View.extend({
        "template": templating.get(viewId),

        "initialize": function () {
            this.initializeViews();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);
        },

        "viewImages":  null,
        "viewVideos":  null,

        "initializeViews": function () {
            this.viewImages = new ImagesView({
                "model": this.model.get('gallery.images'),
            });
            this.viewVideos = new VideosView({
                "model": this.model.get('gallery.videos'),
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