define([
    'jquery',
    'underscore',
    'backbone',
    'templating',
    'iwin-advert/advertModel',
    'iwin-advert/advertView',
    'json!/advertapi',
    'iwin-qual/task',
    'iwin-qual/taskView',
    'json!/taskapi',
    'jquery/openclose',
    'css!config/inner-tabs',
    'domReady!',
], function ($, _, Backbone, templating, AdvertModel, AdvertView, advertData, TaskModel, TaskView, taskData) {
    'use strict';

    var viewId = 'iwin-app-createfree';

    var View = Backbone.View.extend({
        "currentTab": 'task',

        "template": templating.get(viewId),

        "initialize": function () {
            this.views = {
                "advert": new AdvertView({
                    'model': new AdvertModel(advertData),
                }),
                "task":   new TaskView({
                    'model': new TaskModel(taskData),
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