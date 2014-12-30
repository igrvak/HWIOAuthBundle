define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    './categoryCollection',
    './categoryLink',
    'jquery/openclose',
], function ($, _, Backbone, templating, CollectionView, CategoryCollection, CategoryLinkModel) {
    'use strict';

    var viewId = 'iwin-shared-category-categories';

    var View = CollectionView.extend({
        "isMultiple":   true,
        "maxElements":  6,
        "relatedModel": CategoryLinkModel,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function (options) {
            _.extend(this, _.pick(options, 'isMultiple'));

            this.modelBinder = new Backbone.ModelBinder();

            this.on('selectitem', function(el){
                console.log(el.toJSON());
            });

            this.root = new CategoryCollection();
            this.root.on('sync', this.render, this);
            this.root.fetch();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);

            if (!this.isMultiple && this.model.get('list').length === 0) {
                this.addItemEmpty();
            }
        },

        "events": {
            "click .add":                     'addItem',
            "click .remove":                  'removeItem',
            "click [href='#popup-category']": 'selectItem',
        },

        "render": function () {
            this.$el.html(this.template(this.model, {
                "root":        this.root,
                "maxElements": this.maxElements,
            }));

            this.modelBinder.bind(this.model, this.el);
            this.delegateEvents();

            this.$el.find('div.open-close').openClose({
                activeClass: 'active',
                opener:      '.opener',
                slider:      '.slide',
                animSpeed:   400,
                effect:      'slide',
            });

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

        "selectItem": function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                list = this.root,
                index = obj.closest('li').data('ordinal'),
                el = list.at(index);

            this.trigger('selectitem', el);
        },
    });

    return View;
});