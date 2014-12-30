define([
    'lodash',
    'backbone',
    'templating',
    'iwin-shared/social/socialsView',
    'iwin-shared/social/userSocial',
    'iwin-shared/social/userSocialCollection',
    'iwin-shared/social/socialCollection',
    'iwin-shared/images/imageView',
    'iwin-shared/location/locationView'
], function (_, Backbone, templating, SocialsView, UserSocial, UserSocialCollection, SocialCollection, ImageView, LocationView) {
    'use strict';

    var viewId = 'iwin-app-profile';

    var View = Backbone.View.extend({
        "template":     templating.get(viewId),
        "socialsView":  undefined,
        "imageView":    undefined,
        "locationView": undefined,

        "initialize": function () {
            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);

            var view = this;
            var usc = new UserSocialCollection();
            (function () {
                new SocialCollection().fetch({
                    "success": function (model) {
                        model.each(function (elem) {
                            usc.add(new UserSocial({
                                "id":   'rand_' + elem.id + '_' + Math.random(),
                                "type": elem,
                            }));
                        });

                        view.render();
                    }
                });
            })();

            //console.log(this); // TODO: у тебя this.model пустой. Так не должно быть


            this.socialsView = new SocialsView({
                model: usc
            });
            this.imageView = new ImageView();

            this.locationView = new LocationView();

        },

        "render": function () {
            this.$el.html(this.template(this.model));
            this.socialsView.setElement(this.$el.find('.right-block'));
            this.socialsView.render();


            this.imageView.setElement(this.$el.find('.profile-photo'));
            this.imageView.render();

            this.locationView.setElement(this.$el.find('.location'));
            this.locationView.render();
            return this;
        },
    });

    return View;
});