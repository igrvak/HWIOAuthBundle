requirejs([
    'jquery',
    'underscore',
    'iwin-app/images/imageCollection',
    'iwin-app/images/galleryView',
    'domReady!',
], function ($, _, ImageCollection, GalleryView) {
    'use strict';

    var cont = $('#page_target');

    var view = new GalleryView({
        'model': new ImageCollection(),
        'el':    cont,
    });

    view.render();
});