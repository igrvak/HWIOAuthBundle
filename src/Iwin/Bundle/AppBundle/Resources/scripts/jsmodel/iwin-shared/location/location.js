define([
    'lodash',
    'backbone',
    'iwin-app/util/basemodel',
], function (_, Backbone, BaseModel) {
    'use strict';

    var Model = BaseModel.extend({
        "isEmpty": function () {
            return !this.get('address');
        },
    });

    return Model;
});