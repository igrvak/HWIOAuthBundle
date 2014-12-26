define([
    'backbone',
    'iwin-app/util/basemodel',
    'iwin-app/videos/video',
    'iwin-app/videos/videoCollection',
    'iwin-app/images/image',
    'iwin-app/images/imageCollection',
], function (Backbone, BaseModel, Video, VideoCollection, Image, ImageCollection) {
    'use strict';

    var Model = BaseModel.extend({
        "relations": [
            {
                "type":              Backbone.HasMany,
                "key":               'videos',
                "relatedModel":      Video,
                "relatedColelction": VideoCollection,
            }, {
                "type":              Backbone.HasMany,
                "key":               'images',
                "relatedModel":      Image,
                "relatedColelction": ImageCollection,
            },
        ],
    });

    return Model;
});