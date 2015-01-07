define([
    'backbone',
    'util/basemodel',
], function (Backbone, BaseModel) {
    'use strict';

    var Model = BaseModel.extend({
        "idAttribute": 'hash',

        "defaults": {
            "locale":      null,
            "name":        null,
            "description": null,
        },
    });

    return Model;
});