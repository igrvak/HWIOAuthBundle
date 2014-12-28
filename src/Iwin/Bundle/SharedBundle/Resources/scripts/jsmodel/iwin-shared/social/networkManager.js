define([
    'backbone',
    'iwin-shared/social/module/facebook',
    'iwin-shared/social/module/google',
], function (Backbone, Facebook, Google) {
    'use strict';


    var Manager = Backbone.Model.extend({

        "initialize": function () {
            this.set('facebook', new Facebook());
            this.set('gplus', new Google());
        },
        "network":    function (key) {
            return this.get(key);
        }
    });


    return new Manager();
});