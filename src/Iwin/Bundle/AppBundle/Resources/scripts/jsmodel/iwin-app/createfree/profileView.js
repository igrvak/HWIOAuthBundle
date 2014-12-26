define([
    'lodash',
    'backbone',
    'templating',
    'iwin-app/profile/profileView',
], function (_, Backbone, templating, ProfileView) {
    'use strict';

    var viewId = 'iwin-createfree-profile';

    var View = Backbone.View.extend({
        "template": templating.get(viewId),

        "initialize": function () {
            this.viewProfile = new ProfileView({
                "model": this.model,
            });
        },

        "viewProfile":  null,

        "render": function () {
            this.$el.html(this.template());

            this.viewProfile.setElement(this.$el.find('.profile-container'));
            this.viewProfile.render();

            return this;
        },
    });

    return View;
});