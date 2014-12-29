define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'util/collectionView',
    'iwin-shared/social/userSocial',
    'iwin-shared/social/networkManager',
    'backbone/modelbinder'
], function ($, _, Backbone, templating, CollectionView, UserSocial, Manager) {
    'use strict';

    var viewId = 'iwin-app-profile-socials';

    var View = CollectionView.extend({
        "relatedModel": UserSocial,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function () {
            this.modelBinder = new Backbone.ModelBinder();

            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            CollectionView.prototype.initialize.apply(this, arguments);
        },

        "events": {
            "click .connect": 'connect',
            "click .remove":  'remove'
        },

        "render": function () {
            this.$el.html(this.template());
            this.modelBinder.bind(this.model, this.el);
            this.delegateEvents();

            return this;
        },

        "connect": function (event) {
            var socials = this.model.get('list');
            var current = $(event.currentTarget);
            var network = Manager.get(current.data('network')),
                view = this;
            network.login(function () {
                network.getData(function (data) {
                    socials.each(function (social) {
                        if (social.get('type').get('type') !== current.data('network')) {
                            return;
                        }

                        social.set(data);

                    });
                    view.render();
                });
            });
        },
        "remove":  function (event) {
            var socials = this.model.get('list');
            var current = $(event.currentTarget);
            var network = Manager.get(current.data('network')),
                view = this;
            socials.each(function (social) {
                if (social.get('type').get('type') !== current.data('network')) {
                    return;
                }
                social.empty();
            });

            view.render();
        }
    });

    return View;
});