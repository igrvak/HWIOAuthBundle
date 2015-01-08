define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    './selectView',
    './category',
    './categoryCollection',
], function ($, _, Backbone, templating, CollectionView, SelectView, CategoryModel, CategoryCollection) {
    'use strict';

    var viewId = 'iwin-shared-category-categories';

    var View = CollectionView.extend({
        "isMultiple": true,

        "relatedModel": CategoryModel,

        "selectView":  null,
        "selectModel": null,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function (options) {
            _.extend(this, _.pick(options, 'isMultiple'));

            this.modelBinder = new Backbone.ModelBinder();

            this.selectView = new SelectView({
                "model": new CategoryCollection()
            });
            this.selectView.model.get('list').fetch();

            this.selectView.on('confirm', function (el) {
                if (this.selectModel) {
                    this.selectModel.set(el.toJSON());
                } else {
                    this.model.get('list').add(el);
                }
                this.selectLast();
                this.render();
            }, this);

            CollectionView.prototype.initialize.apply(this, arguments);

            this.model.get('list').on('change', this.render, this);

            this.selectLast();
        },

        "events": {
            "click .link-add":    'addItem',
            "click .link-delete": 'removeItem',
            "click .link-change": 'changeItem',
        },

        "render": function () {
            var isFilled = this.model.get('list').length > 0;
            this.$el.html(this.template(this.model, {
                "isFilled":   isFilled,
                "isMultiple": this.isMultiple,
            }));

            this.modelBinder.bind(this.model, this.el);
            this.delegateEvents();

            this.selectView.setElement(this.$el.find('.list-container'));
            this.selectView.isCollapsed = isFilled;
            this.selectView.render();

            return this;
        },

        "selectLast": function () {
            this.selectModel = null;
        },

        "removeItem": function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                list = this.model.get('list'),
                index = obj.closest('li').data('ordinal'),
                el = list.at(index);
            list.remove(el);

            this.selectLast();

            this.render();
        },
        "changeItem": function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                list = this.model.get('list'),
                index = obj.closest('li').data('ordinal'),
                el = list.at(index);

            this.selectModel = el;

            this.selectView.popup();
        },
        "addItem":    function (e) {
            e.preventDefault();
            this.selectLast();

            // TODO: привести в порядок
            this.selectView.childView.model.set('selected', null);
            this.selectView.popup();
        },
    });

    return View;
});