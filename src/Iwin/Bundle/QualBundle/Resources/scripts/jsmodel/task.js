define([
    'backbone',
    'routing',
    'iwin-app/util/basemodel',
    'iwin-app/gallery',
    'iwin-app/profile/profile',
], function (Backbone, Routing, BaseModel, GalleryModel, ProfileModel) {
    'use strict';

    var Model = BaseModel.extend({
        "url": Routing.generate('iwin_task_save'),

        "relations": [
            {
                "type":         Backbone.HasOne,
                "key":          'gallery',
                "relatedModel": GalleryModel,
            }, {
                "type":         Backbone.HasOne,
                "key":          'profile',
                "relatedModel": ProfileModel,
            },
        ],
    });

    return Model;
});