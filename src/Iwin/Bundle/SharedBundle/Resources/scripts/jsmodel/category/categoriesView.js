define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    './selectView',
    './categoryCollection',
    './categoryLink',
], function ($, _, Backbone, templating, CollectionView, SelectView, CategoryCollection, CategoryLinkModel) {
    'use strict';

    var viewId = 'iwin-shared-category-categories';

    var View = CollectionView.extend({
        "isMultiple": true,

        "relatedModel": CategoryLinkModel,

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
                this.selectModel.set('category', el);
                this.selectLast();
                this.render();
            }, this);

            CollectionView.prototype.initialize.apply(this, arguments);

            this.model.get('list').on('change', this.render, this);
            this.model.get('list').on('sync', this.render, this);

            this.selectLast();
        },

        "events": {
            "click .link-add":    'addItem',
            "click .link-delete": 'removeItem',
            "click .link-change": 'changeItem',
        },

        "render": function () {
            var isFilled = !!this.model.get('list[0].category')
            this.$el.html(this.template(this.model, {
                "isFilled":   isFilled,
                "isMultiple": true,
            }));

            this.modelBinder.bind(this.model, this.el);
            this.delegateEvents();

            this.selectView.setElement(this.$el.find('.list-container'));
            this.selectView.isCollapsed = isFilled;
            this.selectView.render();

            return this;
        },

        "selectLast": function () {
            if(!this.model.get('list').length){
                this.addItemEmpty();
                return;
            }
            this.selectModel = this.model.get('list').at(this.model.get('list').length - 1);
            if (this.selectModel.get('category')) {
                this.addItemEmpty();
            }
        },

        "addItemEmpty": function () {
            var el = CollectionView.prototype.addItemEmpty.apply(this, arguments);
            this.selectModel = el;
            return el;
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