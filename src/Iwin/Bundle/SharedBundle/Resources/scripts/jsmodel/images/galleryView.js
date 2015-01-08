define([
    'lodash',
    'backbone',
    'templating',
    'routing',
    'dropzone',
    'util/collectionView',
    './image',
    'jqueryui',
], function (_, Backbone, templating, Routing, Dropzone, CollectionView, ImageModel) {
    'use strict';

    var viewId = 'iwin-shared-images-gallery';

    var View = CollectionView.extend({
        "relatedModel": ImageModel,
        "isMultiple":   true,
        "dropzone":     null,
        "template":     templating.get(viewId),

        "initialize": function (options) {
            _.extend(this, _.pick(options, 'isMultiple', 'model'));

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);

        },

        "events": {
            "click .remove":    'removeImage',
            "sortstop .images": "sortStop",
        },

        "removeDropzone": function () {
            if (this.dropzone) {
                this.dropzone.disable(); // TODO: CHECK CHECK CHECK
            }
            this.dropzone = null;
        },

        "remove": function () {
            this.removeDropzone();

            CollectionView.prototype.remove.apply(this, arguments);
        },

        "render": function () {
            this.removeDropzone();

            this.$el.html(this.template(this.model, {
                'isMultiple': this.isMultiple,
            }));

            this.$el.find('.drop').each(_.bind(function (ind, el) {
                this.dropzone = new Dropzone(el, {
                    "url": Routing.generate('_uploader_upload_gallery'),
                });
            }, this));
            this.dropzone.on('success', _.bind(function (event, data) {
                if(!this.isMultiple){
                    this.model.get('list').first().set(data);
                } else {
                    this.model.get('list').add(new ImageModel(data));
                }
                this.render();
            }, this));

            this.$el.find('.images').sortable({
                "items": "li.image",
            }).disableSelection();

            return this;
        },

        "removeImage": function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                index = obj.closest('li').data('ordinal');

            var el = this.model.get('list').at(index);
            this.model.get('list').remove(el);
            this.render();
        },

        "sortStop": function (e, ui) {
            // Обновляем индекс в коллекции
            // TODO: быдлокод
            this.model.get('list').updateOrdinal(
                ui.item.data('ordinal'),
                ui.item.index()
            );
            ui.item.data('ordinal', ui.item.index());
            this.render();
        },
    });

    return View;
});