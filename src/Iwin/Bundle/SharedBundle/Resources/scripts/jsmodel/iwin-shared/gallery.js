define([
    'backbone',
    'util/basemodel',
    'iwin-shared/videos/video',
    'iwin-shared/videos/videoCollection',
    'iwin-shared/images/image',
    'iwin-shared/images/imageCollection',
], function (Backbone, BaseModel, Video, VideoCollection, Image, ImageCollection) {
    'use strict';

    var Model = BaseModel.extend({
        "relations": [
            {
                "type":              Backbone.HasMany,
                "key":               'videos',
                "relatedModel":      Video,
                "relatedCollection": VideoCollection,
            }, {
                "type":              Backbone.HasMany,
                "key":               'images',
                "relatedModel":      Image,
                "relatedCollection": ImageCollection,
            },
        ],
    });

    return Model;
});