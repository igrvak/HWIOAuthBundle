define([
    'lodash',
    'backbone',
    'util/basemodel',
], function (_, Backbone, BaseModel) {
    'use strict';

    var usaCenter = {
        "lat":  41.29911550842562,
        "long": -93.86230468749999,
    };

    var Model = BaseModel.extend({
        "defaults": {
            "address": null,
            "posLat":  usaCenter.lat,
            "posLong": usaCenter.long,
        },

        "isEmpty": function () {
            return !this.get('address');
        },
    });

    return Model;
});