define([
    'lodash',
    'backbone',
    'templating',
    'routing',
    'dropzone',
    './image',
], function (_, Backbone, templating, Routing, Dropzone, ImageModel) {
    'use strict';

    var viewId = 'iwin-app-images-gallery';

    var View = Backbone.View.extend({
        "dropzone": null,
        "template": templating.get(viewId),

        "initialize": function () {
            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);
        },

        "render": function () {
            if (this.dropzone) {
                this.dropzone.disable();
            }

            this.$el.html(this.template({
                'list': this.model,
            }));

            this.$el.find('.drop').each(_.bind(function (ind, el) {
                this.dropzone = new Dropzone(el, {
                    url: Routing.generate('_uploader_upload_gallery'),
                });
            }, this));
            this.dropzone.on('success', _.bind(function (event, data) {
                this.model.add(new ImageModel(data));
                this.render();
            }, this));

            return this;
        },
    });

    return View;
});