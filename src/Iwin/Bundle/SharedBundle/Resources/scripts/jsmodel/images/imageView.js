define([
    'lodash',
    'backbone',
    './galleryView',
    './imageCollection',
], function (_, Backbone, GalleryView, ImageCollection) {
    'use strict';

    var View = GalleryView.extend({
        "initialize": function () {
            this.isMultiple = false;
            this.model = new ImageCollection([
                this.model,
            ]);

            GalleryView.prototype.initialize.apply(this, arguments);
        },
    });

    return View;
});