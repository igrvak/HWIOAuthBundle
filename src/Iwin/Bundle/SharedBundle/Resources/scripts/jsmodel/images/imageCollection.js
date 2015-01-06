define([
    'lodash',
    'backbone',
    './image',
], function (_, Backbone, ImageModel) {
    'use strict';

    var Collection = Backbone.Collection.extend({
        "model": ImageModel,

        "updateOrdinal": function (i1, i2) {
            // http://stackoverflow.com/questions/10147969/saving-jquery-ui-sortables-order-to-backbone-js-collection
            var model = this.at(i1);
            this.remove(model);

            this.each(function (model, index) {
                var ordinal = index;
                if (index >= i2) {
                    ordinal += 1;
                }
                model.set('ordinal', ordinal);
            });

            model.set('ordinal', i2);
            this.add(model, {
                "at": i2,
            });
        },
    });

    return Collection;
});