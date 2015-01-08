define([
    'lodash',
    'backbone',
    'util/basemodel',
    'iwin-shared/images/image',
], function (_, Backbone, BaseModel, ImageModel) {
    'use strict';

    var Model = BaseModel.extend({
        "defaults": {
            "isLeaf": false,
        },

        "relations": [
            {
                "type":         Backbone.HasOne,
                "key":          'image',
                "relatedModel": ImageModel,
            }, {
                "type":         Backbone.HasOne,
                "key":          'parent',
                "relatedModel": Model,
            },
        ],

        "getParentNodesArray": function (min) {
            var obj = this,
                ret = {};

            do {
                ret[obj.get('level')] = obj;
            } while (obj = obj.get('parent'));
            if (min) {
                _.each(_.range(1, min + 1), function (ind) {
                    if (!ret[ind]) {
                        ret[ind] = {};
                    }
                });
            }
            return ret;
        },
    });

    return Model;
});