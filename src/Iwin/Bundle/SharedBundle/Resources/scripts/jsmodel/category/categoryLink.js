define([
    'lodash',
    'backbone',
    'util/basemodel',
    './category',
], function (_, Backbone, BaseModel, CategoryModel) {
    'use strict';

    var Model = BaseModel.extend({
        "relations": [
            {
                "type":         Backbone.HasOne,
                "key":          'category',
                "relatedModel": CategoryModel,
            },
        ],
    });

    return Model;
});