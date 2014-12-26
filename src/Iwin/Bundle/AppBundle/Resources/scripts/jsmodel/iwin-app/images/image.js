define([
    'backbone',
    'iwin-app/util/basemodel',
], function (Backbone, BaseModel) {
    'use strict';

    var Model = BaseModel.extend({
        "idAttribute": 'hash',

        "defaults": {
            "uri":     null, // Не url !!!
            "hash":    null,
            "ordinal": 0,
        },
    });

    return Model;
});