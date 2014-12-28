define([
    'backbone',
    'routing',
    'util/basemodel',
    'iwin-app/gallery',
    'iwin-app/profile/profile',
    'iwin-shared/category/category',
    'iwin-shared/location/location',
    'iwin-shared/location/locationCollection',
], function (Backbone, Routing, BaseModel, GalleryModel, ProfileModel, CategoryModel, LocationModel, LocationCollection) {
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
            }, {
                "type":         Backbone.HasOne,
                "key":          'category',
                "relatedModel": CategoryModel,
            }, {
                "type":              Backbone.HasMany,
                "key":               'locations',
                "relatedModel":      LocationModel,
                "relatedCollection": LocationCollection,
            },
        ],
    });

    return Model;
});