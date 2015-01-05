define([
    'lodash',
    'backbone',
    'templating',
    'iwin-app/profile/profileView',
    'jquery/openclose',
], function (_, Backbone, templating, ProfileView) {
    'use strict';

    var viewId = 'iwin-createfree-profile';

    var View = Backbone.View.extend({
        "template":    templating.get(viewId),
        "viewProfile": undefined,

        "initialize": function () {
            this.viewProfile = new ProfileView({
                "model": this.model,
            });

        },


        "render": function () {
            this.$el.html(this.template());

            this.viewProfile.setElement(this.$el.find('.profile-container'));
            this.viewProfile.render();


            this.$el.find('div.open-close').openClose({
                activeClass: 'active',
                opener:      '.opener',
                slider:      '.slide',
                animSpeed:   400,
                effect:      'slide',
            });

            return this;
        },
    });

    return View;
});