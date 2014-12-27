define([
    'lodash',
    'backbone',
    'templating',
    'iwin-shared/social/socialsView',
    'iwin-shared/social/userSocial',
    'iwin-shared/social/userSocialCollection',
    'iwin-shared/social/socialCollection',
], function (_, Backbone, templating, SocialsView, UserSocial, UserSocialCollection, SocialCollection) {
    'use strict';

    var viewId = 'iwin-app-profile';

    var View = Backbone.View.extend({
        "template":    templating.get(viewId),
        "socialsView": undefined,

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
                                "id":   'rand_'+elem.id + '_' + Math.random(),
                                "type": elem,
                            }));
                        });

                        view.render();
                    }
                });
            })();

            this.socialsView = new SocialsView({
                model: usc
            });
            //console.log(this); // TODO: у тебя this.model пустой. Так не должно быть
        },

        "render": function () {
            this.$el.html(this.template(this.model));
            this.socialsView.setElement(this.$el.find('.right-block'));
            this.socialsView.render();
            return this;
        },
    });

    return View;
});