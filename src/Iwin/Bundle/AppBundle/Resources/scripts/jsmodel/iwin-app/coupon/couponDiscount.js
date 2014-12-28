define([
    'backbone',
    'util/basemodel',
], function (Backbone, BaseModel) {
    'use strict';

    var Model = BaseModel.extend({
        "defaults": {
            "amount":     0,
            "isAbsolute": 0,
        },
    });

    return Model;
});