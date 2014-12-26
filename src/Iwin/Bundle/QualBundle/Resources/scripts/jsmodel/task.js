define([
    'backbone',
    'routing',
    'iwin-app/util/basemodel',
    'iwin-app/gallery',
], function (Backbone, Routing, BaseModel, GalleryModel) {
    'use strict';

    var Model = BaseModel.extend({
        "url": Routing.generate('iwin_task_save'),

        "relations": [
            {
                "type":         Backbone.HasOne,
                "key":          'gallery',
                "relatedModel": GalleryModel,
            },
        ],
    });

    return Model;
});