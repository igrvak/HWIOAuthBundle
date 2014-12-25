define([
    'backbone',
    'iwin-app/util/basemodel',
    'iwin-app/videos/videoCollection',
    'iwin-app/images/imageCollection',
], function (Backbone, BaseModel, VideoCollection, ImageCollection) {
    'use strict';

    var Model = BaseModel.extend({
        "relations": [
            {
                "type":              Backbone.HasMany,
                "key":               'videos',
                "relatedModel":      VideoCollection.model,
                "relatedColelction": VideoCollection,
            }, {
                "type":              Backbone.HasMany,
                "key":               'images',
                "relatedModel":      ImageCollection.model,
                "relatedColelction": ImageCollection,
            },
        ],
    });

    return Model;
});