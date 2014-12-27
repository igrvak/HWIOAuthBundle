define([
    'lodash',
    'backbone',
    'templating',
], function (_, Backbone, templating) {
    'use strict';

    var viewId = 'iwin-app-profile';

    var View = Backbone.View.extend({
        "template": templating.get(viewId),

        "initialize": function () {
            this.model.on('change', this.render, this);
            this.model.on('sync', this.render, this);
        },

        "render": function () {
            this.$el.html(this.template(this.model));

            return this;
        },
    });

    return View;
});