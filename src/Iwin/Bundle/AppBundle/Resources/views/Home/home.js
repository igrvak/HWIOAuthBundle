requirejs([
    'jquery',
    'underscore',
    'iwin-app/images/imageCollection',
    'iwin-app/images/galleryView',
    'iwin-app/videos/videoCollection',
    'iwin-app/videos/videosView',
    'jquery/openclose',
    'domReady!',
], function ($, _, ImageCollection, GalleryView, VideoCollection, VideosView) {
    'use strict';

    var cont = $('#page_target');

    cont.find('div.open-close').openClose({
        activeClass: 'active',
        opener:      '.opener',
        slider:      '.slide',
        animSpeed:   400,
        effect:      'slide',
    });

    var view1 = new GalleryView({
        'model': new ImageCollection(),
        'el':    cont.find('.gallery-container'),
    });
    view1.render();

    var view2 = new VideosView({
        'model': new VideoCollection(),
        'el':    cont.find('.videos-container'),
    });
    view2.render();
});