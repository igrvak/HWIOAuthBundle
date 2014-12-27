define([
    'jquery',
    'lodash',
    'backbone',
    'iwin-app/util/basemodel',
], function ($, _, Backbone, BaseModel) {
    'use strict';

    var Model = BaseModel.extend({
        "idAttribute": 'type',


        defaults: {
            "type":     "",
            "isActive": false
        }
    });

    return Model;

});