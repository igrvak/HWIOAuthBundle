define([
    'lodash',
    'backbone',
    './map',
], function (_, Backbone, Map) {
    'use strict';

    var View = Backbone.View.extend({
        "mapCont": null,

        "initialize": function () {
            this.mapCont = document.createElement('div');

            if (!this.model) {
                this.model = new Map([ // TODO: move
                    41.29911550842562,
                    -93.86230468749999,
                ]);
            }

            this.model.show(this.mapCont);
            console.log(this.model);
        },

        "render": function () {
            this.$el.append(this.mapCont);

            this.$(this.mapCont).css({
                "width":  this.$el.width(),
                "height": this.$el.height(),
            });

            return this;
        },
    });

    return View;
});