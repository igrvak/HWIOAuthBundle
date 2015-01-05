define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    './categoryCollection',
    './categoryLink',
    'jquery/openclose',
    'jquery/malihu-scrollbar/scroll',
    'fancybox/fancybox',
], function ($, _, Backbone, templating, CollectionView, CategoryCollection, CategoryLinkModel) {
    'use strict';

    var viewId = 'iwin-shared-category-list';

    var cols = {
        '1': 'first',
        '2': 'second',
        '3': 'third',
    };

    var View = CollectionView.extend({
        "isPopup":   false,
        "childView": null,

        "subCategories": {},
        "maxElements":   6,
        "relatedModel":  CategoryLinkModel,

        "template": templating.get(viewId),

        "initialize": function (options) {
            _.extend(this, _.pick(options, 'isPopup'));

            if (!this.isPopup) {
                this.childView = new View({
                    "model":   new CategoryCollection(),
                    "isPopup": true,
                });
                this.childView.model.get('list').fetch();
            }

            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);

            if (this.isPopup) {
                _.each(_.keys(cols), function (ind) {
                    this.subCategories[ind] = new CategoryCollection();
                    this.subCategories[ind].on('sync', this.render, this);
                }, this);

                this.model.on('change:selected', function () {
                    var el = this.model.get('selected');
                    if(!el){
                        return;
                    }
                    var parents = el.getParentNodesArray(_.keys(cols).length);
                    _.each(parents, function(obj, ind){
                        var list = this.subCategories[ind];
                        if(list.parent.id !== obj.id) {
                            list.parent = obj;
                            list.fetch();
                        }
                    }, this);
                }, this);
            }

            if (!this.isMultiple && this.model.get('list').length === 0) {
                this.addItemEmpty();
            }
        },

        "events": {
            "click .link-back":               'back',
            "click .close":                   'closeFancybox',
            "click .select-cat":              'selectSubItem',
            "click [href='#popup-category']": 'selectItem',
        },

        "render": function () {
            this.$el.find('.scroll-block').mCustomScrollbar('destroy');

            var opts = {
                "isPopup":       this.isPopup,
                "maxElements":   this.isPopup ? null : this.maxElements,
                "subCategories": this.isPopup ? this.subCategories : null,
            };
            if (this.isPopup) {
                _.extend(opts, {
                    "selected": this.model.get('selected'),
                    "cols":     cols,
                });
            }
            this.$el.html(this.template(this.model, opts));

            this.delegateEvents();

            this.$el.find('div.open-close').openClose({
                activeClass: 'active',
                opener:      '.opener',
                slider:      '.slide',
                animSpeed:   400,
                effect:      'slide',
            });

            this.$el.find('.scroll-block').mCustomScrollbar({
                mouseWheelPixels: 400,
                advanced:         {
                    updateOnContentResize: true,
                    updateOnBrowserResize: true,
                },
                scrollButtons:    {
                    enable: false,
                },
            });

            return this;
        },

        "setItem": function (item) {
            this.trigger('selectitem', item);

            if (!this.isPopup) {
                $.fancybox({
                    "href":      '#popup-category',
                    "padding":   0,
                    "closeBtn":  false,
                    "scrolling": false,
                });
            }

            var view = this.isPopup ? this : this.childView;

            view.model.set('selected', item);
            view.setElement($('.fancybox-wrap .popup-category'));
            view.render();
        },

        "selectItem": function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                list = this.model.get('list'),
                index = obj.closest('li').data('ordinal'),
                el = list.at(index);

            this.setItem(el);
        },

        "selectSubItem": function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                id = obj.closest('li').data('id'),
                col = obj.closest('li').data('col'),
                el = this.subCategories[col].get(id);

            this.setItem(el);
        },

        "closeFancybox": function (e) {
            e.preventDefault();
            $.fancybox.close();
        },

        "back": function (e) {
            e.preventDefault();
            var model = this.model.get('selected');
            if (!model) {
                return;
            }

            if (Number(model.get('level')) === 1) {
                this.model.set('selected', null);
            } else {
                this.model.set('selected', model.get('parent'));
            }
            this.render();
        }
    });

    return View;
});