define([
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    './video',
    'backbone/modelbinder',
], function (_, Backbone, templating, CollectionView, VideoModel) {
    'use strict';

    var viewId = 'iwin-shared-videos-video';

    var View = CollectionView.extend({
        "relatedModel": VideoModel,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function () {
            this.modelBinder = new Backbone.ModelBinder();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);
        },

        "events": {
            "click .add":    'addVideo',
            "click .remove": 'removeVideo',
        },

        "render": function () {
            this.$el.html(this.template());
            this.modelBinder.bind(this.model, this.el);
            this.delegateEvents();

            return this;
        },

        "addVideo": function () {
            var input = this.$el.find('input.new');
            if (!input.val()) {
                window.alert('Введите адрес видео');
                return;
            }

            this.model.get('list').add(new VideoModel({
                'uri': input.val(),
            }));
            this.render();
        },
        "removeVideo": function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                index = obj.closest('li').data('ordinal');

            var el = this.model.get('list').at(index);
            this.model.get('list').remove(el);
            this.render();
        },
    });

    return View;
});