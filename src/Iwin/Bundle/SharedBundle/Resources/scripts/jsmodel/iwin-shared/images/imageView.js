define([
    'lodash',
    'backbone',
    './galleryView',
    './image',
    './imageCollection',
], function (_, Backbone, GalleryView, ImageModel, ImageCollection) {
    'use strict';

    var View = GalleryView.extend({
        "initialize": function () {
            var args = _.toArray(arguments),
                options = args.shift() || {};

            options.model = new ImageCollection([
                options.model ? options.model : new ImageModel(),
            ]);

            options.isMultiple = false;

            args.unshift(options);

            GalleryView.prototype.initialize.apply(this, args);
        },
    });

    return View;
});