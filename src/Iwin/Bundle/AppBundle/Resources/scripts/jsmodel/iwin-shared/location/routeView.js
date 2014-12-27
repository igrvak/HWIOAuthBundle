define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'iwin-app/util/collectionView',
    './location',
    './mapView',
    'fancybox/fancybox',
    'backbone/modelbinder',
], function ($, _, Backbone, templating, CollectionView, LocationModel, MapView) {
    'use strict';

    var viewId = 'iwin-app-location-route';

    var View = CollectionView.extend({
        "relatedModel": LocationModel,
        "viewMap":      undefined,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function () {
            this.modelBinder = new Backbone.ModelBinder();

            this.viewMap = new MapView();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            if (!this.model.length) {
                this.model.add(new LocationModel());
            }

            CollectionView.prototype.initialize.apply(this, arguments);
        },

        "events": {
            "click .add":    'addItem',
            "click .remove": 'removeItem',
        },

        "render": function () {
            this.$el.html(this.template());

            var map = this.viewMap, that = this;
            this.$el.find('[href="#popup-location"]').fancybox({
                "padding":   0,
                "closeBtn":  false,
                "scrolling": false,

                "beforeShow":  function () {
                    var obj = this.element.closest('li').data('ordinal');
                    obj = that.model.get('list').at(obj);

                    var mapCont = this.content.find('#map'),
                        input = this.content.find('.address'),
                        button = this.content.find('.confirm');

                    this.content.find('.action-close').click(function (e) {
                        e.preventDefault();
                        $.fancybox.close();
                    });

                    input.bind('change', function () {
                        button.toggleClass('disabled', !input.val());
                    });
                    button.click(function (e) {
                        e.preventDefault();
                        if ($(this).hasClass('disabled')) {
                            return;
                        }

                        obj.set(input.data('pos'));
                        that.render();
                        $.fancybox.close();
                    });

                    map.setElement(mapCont);
                    map.render();

                    map.model.setAddressCallback(function (address, pos) {
                        input.val(address);
                        input.data('pos', {
                            'address': address,
                            'posLat':  pos.lat(),
                            'posLong': pos.lng(),
                        });
                        input.trigger('change');
                    });
                },
                "afterShow":   function () {
                    map.model.repaint();
                },
                "beforeClose": function () {
                    map.model.setAddressCallback(null);
                },
            });

            this.modelBinder.bind(this.model, this.el);
            this.delegateEvents();

            return this;
        },

        "addItem":    function (e) {
            e.preventDefault();
            var list = this.model.get('list');

            if (list.at(list.length - 1).isEmpty()) {
                window.alert('Укажите адрес!');
                return;
            }

            list.add(new LocationModel());
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