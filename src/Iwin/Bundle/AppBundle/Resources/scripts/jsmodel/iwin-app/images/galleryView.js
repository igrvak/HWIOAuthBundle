define([
    'lodash',
    'backbone',
    'templating',
    'routing',
    'dropzone',
    'iwin-app/util/collectionView',
    './image',
], function (_, Backbone, templating, Routing, Dropzone, CollectionView, ImageModel) {
    'use strict';

    var viewId = 'iwin-app-images-gallery';

    var View = CollectionView.extend({
        "relatedModel": ImageModel,

        "dropzone": null,
        "template": templating.get(viewId),

        "initialize": function () {
            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);
        },

        "events": {
            "click .remove": 'removeImage',
        },

        "render": function () {
            if (this.dropzone) {
                this.dropzone.disable();
            }

            this.$el.html(this.template(this.model));

            this.$el.find('.drop').each(_.bind(function (ind, el) {
                this.dropzone = new Dropzone(el, {
                    "url": Routing.generate('_uploader_upload_gallery'),
                });
            }, this));
            this.dropzone.on('success', _.bind(function (event, data) {
                this.model.get('list').add(new ImageModel(data));
                this.render();
            }, this));

            return this;
        },

        "removeImage": function (e) {
            var obj = this.$(e.currentTarget),
                index = obj.data('objid');

            var el = this.model.get('list').at(index);
            this.model.get('list').remove(el);
            this.render();
        },
    });

    return View;
});