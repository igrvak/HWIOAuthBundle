define([
    'lodash',
    'backbone',
    'templating',
    'iwin-app/util/collectionView',
    './location',
    'backbone/modelbinder',
], function (_, Backbone, templating, CollectionView, LocationModel) {
    'use strict';

    var viewId = 'iwin-app-location-route';

    var View = CollectionView.extend({
        "relatedModel": LocationModel,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function () {
            this.modelBinder = new Backbone.ModelBinder();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);
        },

        "events": {
            "click .add":    'addItem',
            "click .remove": 'removeItem',
        },

        "render": function () {
            this.$el.html(this.template());
            this.modelBinder.bind(this.model, this.el);
            this.delegateEvents();

            return this;
        },

        "addItem": function () {
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
        "removeItem": function (e) {
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