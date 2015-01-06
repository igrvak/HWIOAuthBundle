define([
    'lodash',
    'backbone',
    'routing',
    './category',
], function (_, Backbone, Routing, CategoryModel) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model":  CategoryModel,
        "parent": null,

        "url": function () {
            return this.parent ?
                Routing.generate('iwin_shared_category_list', {"category": this.parent.id}) :
                Routing.generate('iwin_shared_category_root');
        },
    });

    return Collection;
});