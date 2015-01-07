define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    './category',
    './categoryCollection',
    'jquery/openclose',
    'jquery/malihu-scrollbar/scroll',
    'fancybox/fancybox',
], function ($, _, Backbone, templating, CollectionView, CategoryModel, CategoryCollection) {
    'use strict';

    var viewId = 'iwin-shared-category-list';

    var cols = {
        '1': 'first',
        '2': 'second',
        '3': 'third',
    }, colsMax = _.keys(cols).length;

    var View = CollectionView.extend({
        "isPopup":     false,
        "isCollapsed": false,
        "childView":   null,

        "subCategories": {},
        "maxElements":   6,
        "relatedModel":  CategoryModel,

        "template": templating.get(viewId),

        "initialize": function (options) {
            _.extend(this, _.pick(options, 'isPopup'));

            if (!this.isPopup) {
                this.childView = new View({
                    "model":   this.model,
                    "isPopup": true,
                });
                this.childView.on('confirm', function (el) {
                    this.trigger('confirm', el);
                }, this);
            }

            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);

            if (this.isPopup) {
                _.each(_.keys(cols), function (ind) {
                    this.subCategories[ind] = new CategoryCollection();
                    this.subCategories[ind].on('change', this.render, this);
                    this.subCategories[ind].on('sync', this.render, this);
                }, this);

                this.model.on('change:selected', function () {
                    var el = this.model.get('selected');
                    if (!(el && el.get('level') > 0 && !el.get('isLeaf'))) {
                        return;
                    }
                    var parents = el.getParentNodesArray(colsMax);
                    _.each(parents, function (obj, ind) {
                        var list = this.subCategories[ind];
                        if (!obj.id) {
                            list.parent = null;
                            list.reset();
                        } else if (!list.parent || list.parent.id !== obj.id) {
                            list.parent = obj;
                            list.reset();
                            list.fetch();
                        }
                    }, this);
                    this.render();
                }, this);
            }
        },

        "events": {
            "click .link-back":               'back',
            "click .action-close":            'closeFancybox',
            "click .action-confirm":          'confirmSelected',
            "click .select-cat":              'selectSubItem',
            "click [href='#popup-category']": 'selectItem',
        },

        "render": function () {
            this.$el.find('.scroll-block').mCustomScrollbar('destroy');

            var opts = {
                "isPopup":       this.isPopup,
                "isCollapsed":   this.isCollapsed,
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

        "popup": function () {
            $.fancybox({
                "href":      '#popup-category',
                "padding":   0,
                "closeBtn":  false,
                "scrolling": false,
                "afterShow": _.bind(function () {
                    this.childView.setElement($('.fancybox-wrap .popup-category'));
                    this.childView.render();
                }, this),
            });
        },

        "setItem": function (item) {
            this.trigger('selectitem', item);

            var view = this.isPopup ? this : this.childView;
            view.model.set('selected', item);

            if (!this.isPopup) {
                this.popup();
            } else {
                this.render();
            }
        },

        "selectItem": function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                list = this.model.get('list'),
                index = obj.closest('li').data('ordinal'),
                el = list.at(index);

            this.setItem(el);
        },

        "confirmSelected": function (e) {
            e.preventDefault();
            var el = this.model.get('selected');

            if (!el.get('isLeaf')) {
                return;
            }

            this.trigger('confirm', el);
            this.closeFancybox(e);
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
                this.model.set('selected', model.getParentNodesArray(1)[1]);
            }
            this.render();
        }
    });

    return View;
});