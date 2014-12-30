define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    './location',
    './mapView',
    'fancybox/fancybox',
    'backbone/modelbinder',
], function ($, _, Backbone, templating, CollectionView, LocationModel, MapView) {
    'use strict';

    var viewId = 'iwin-shared-location-route';

    var View = CollectionView.extend({
        "relatedModel": LocationModel,
        "viewMap":      undefined,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function () {
            this.modelBinder = new Backbone.ModelBinder();

            this.viewMap = new MapView({
                "model": new this.relatedModel(),
            });

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);

            if (!this.model.get('list').length) {
                this.addItemEmpty();
            }
        },

        "events": {
            "click .add":    'addItem',
            "click .remove": 'removeItem',
        },

        "render": function () {
            this.$el.html(this.template());

            var map = this.viewMap, that = this, clb;
            this.$el.find('[href="#popup-location"]').click(function (e) {
                e.preventDefault();

                var obj = $(e.currentTarget).closest('li').data('ordinal');
                obj = that.model.get('list').at(obj);

                $.fancybox({
                    "href":      '#popup-location',
                    "padding":   0,
                    "closeBtn":  false,
                    "scrolling": false,

                    "afterShow":   function () {
                        var mapCont = this.content.find('#map'),
                            input = this.content.find('.address'),
                            button = this.content.find('.confirm');

                        this.content.find('.action-close').click(function (e) {
                            e.preventDefault();
                            $.fancybox.close();
                        });

                        input.val(obj.get('address'));
                        input.bind('change', function () {
                            button.toggleClass('disabled', !input.val());
                        });
                        button.click(function (e) {
                            e.preventDefault();
                            if ($(this).hasClass('disabled')) {
                                return;
                            }

                            obj.set(map.model.toJSON());
                            that.render();
                            $.fancybox.close();
                        });

                        map.setElement(mapCont);
                        map.render();
                        map.updatePosition(new that.relatedModel(obj.toJSON()));

                        clb = function (address) {
                            input.val(address);
                            input.data('pos', this.pos);
                            input.trigger('change');
                        };

                        map.on('map:address', clb);
                    },
                    "beforeClose": function () {
                        map.off('map:address', clb);
                    },
                });
            });

            this.modelBinder.bind(this.model, this.el);
            this.delegateEvents();

            return this;
        },

        "addItem":      function (e) {
            e.preventDefault();
            var list = this.model.get('list');

            if (list.at(list.length - 1).isEmpty()) {
                window.alert('Укажите адрес!');
                return;
            }

            this.addItemEmpty();
            this.render();

            this.$el.find('[href="#popup-location"]').last().click();
        },
        "removeItem":   function (e) {
            e.preventDefault();
            var obj = this.$(e.currentTarget),
                list = this.model.get('list'),
                index = obj.closest('li').data('ordinal');

            var el = list.at(index);
            list.remove(el);

            if (!this.model.get('list').length) {
                this.addItemEmpty();
            }

            this.render();
        },
    });

    return View;
});