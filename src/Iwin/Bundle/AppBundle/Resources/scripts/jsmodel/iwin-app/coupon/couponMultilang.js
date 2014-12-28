define([
    'backbone',
    'util/basemodel',
], function (Backbone, BaseModel) {
    'use strict';

    var Model = BaseModel.extend({
        "idAttribute": 'hash',

        "defaults": {
            "lang":    null,
            "name":    null,
            "caption": null,
        },
    });

    return Model;
});