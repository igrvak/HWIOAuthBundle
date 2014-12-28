define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    './category',
], function ($, _, Backbone, templating, CollectionView, CategoryModel) {
    'use strict';

    var viewId = 'iwin-shared-category-categories';

    var View = CollectionView.extend({
        "isMultiple":   true,
        "relatedModel": CategoryModel,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function (options) {
            _.extend(this, _.pick(options, 'isMultiple'));

            this.modelBinder = new Backbone.ModelBinder();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);

            if (!this.isMultiple && this.model.get('list').length === 0) {
                this.addItemEmpty();
            }
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

        "addItem":    function (e) {
            e.preventDefault();

            if (!this.isMultiple) {
                throw 'Multiple categories not allowed';
            }

            var list = this.model.get('list');

            this.model.get('list').add(new this.relatedModel());
            this.render();
        },
        "removeItem": function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                list = this.model.get('list'),
                index = obj.closest('li').data('ordinal');

            var el = list.at(index);
            list.remove(el);

            this.render();
        },
    });

    return View;
});