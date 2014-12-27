define([
    'jquery',
    'lodash',
    'backbone',
    'iwin-app/util/basemodel',
    'iwin-shared/social/social',
], function ($, _, Backbone, BaseModel, Type) {
    'use strict';

    var Model = BaseModel.extend({
        "isEmpty":   function () {
            return !this.get('link');
        },
        "defaults":  {
            "id":    "",
            "name":  "",
            "photo": "",
            "link":  "",
        },
        "relations": [
            {
                "type":         Backbone.HasOne,
                "key":          'type',
                "relatedModel": Type,
            }
        ],

        "empty": function () {
            var type = this.get('type'),
                id = this.get('id');

            this.clear().set(this.defaults).set({
                'type': type,
                'id':   id
            });
        },

        "toJSON": function () {
            var data = BaseModel.prototype.toJSON.apply(this, arguments);

            if (data.id.indexOf('rand_') > -1) {
                delete data.id;
            }

            return data;
        },
    });

    return Model;

});