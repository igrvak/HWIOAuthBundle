define([
    'jquery',
    'underscore',
    'backbone',
    'templating',
    'iwin-advert/advertView',
    'iwin-qual/taskView',
    './profileView',
    'jquery/openclose',
    'scss!config/inner-tabs',
    'domReady!',
], function ($, _, Backbone, templating, AdvertView, TaskView, ProfileView) {
    'use strict';

    var viewId = 'iwin-app-createfree';

    var View = Backbone.View.extend({
        "currentTab": 'task',

        "template": templating.get(viewId),

        "initialize": function () {
            this.views = {
                "advert":  new AdvertView({
                    'model': this.model.advert,
                }),
                "task":    new TaskView({
                    'model': this.model.task,
                }),
                "profile": new ProfileView({
                    'model': this.model.profile,
                }),
            };
        },

        "events": {
            "click .tabset a": 'selectTab',
        },

        "render": function () {
            this.$el.html(this.template({
                "currentTab": this.currentTab,
                "tabs":       {
                    "advert":  'AD',
                    "task":    'Task',
                    "profile": 'Profile',
                },
            }));

            var view = this.views[this.currentTab];
            view.setElement(this.$el.find('.advertmodel-container'));
            view.render();

            return this;
        },

        "selectTab": function (e) {
            e.preventDefault();
            var obj = $(e.currentTarget);

            this.currentTab = obj.data('tab');
            this.render();
        },
    });

    return View;
});