define([
    'lodash',
    'backbone',
    'util/basemodel',
    'iwin-shared/images/image',
], function (_, Backbone, BaseModel, ImageModel) {
    'use strict';

    var Model = BaseModel.extend({
        "relations": [
            {
                "type":         Backbone.HasOne,
                "key":          'image',
                "relatedModel": ImageModel,
            },
        ],
    });

    return Model;
});