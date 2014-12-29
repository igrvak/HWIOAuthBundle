define([
    'backbone',
    'iwin-shared/social/module/facebook',
    'iwin-shared/social/module/google',
    'iwin-shared/social/module/linkedin',
], function (Backbone, Facebook, Google, LinkedIn) {
    'use strict';


    var Manager = Backbone.Model.extend({

        "initialize": function () {
            this.set('facebook', new Facebook());
            this.set('gplus', new Google());
            this.set('linkedin', new LinkedIn());
        },
        "network":    function (key) {
            return this.get(key);
        }
    });


    return new Manager();
});