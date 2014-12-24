define([
    'lodash',
    'backbone',
    'templating',
    'iwin-app/util/collectionView',
    './video',
    'backbone/modelbinder',
], function (_, Backbone, templating, CollectionView, VideoModel) {
    'use strict';

    var viewId = 'iwin-app-videos-videos';

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
            var obj = this.$(e.currentTarget),
                index = obj.data('objid');

            var el = this.model.get('list').at(index);
            this.model.get('list').remove(el);
            this.render();
        },
    });

    return View;
});