requirejs([
    'jquery',
    'underscore',
    'dropzone'
], function ($, _, Dropzone) {
    'use strict';

    var dropzone = new Dropzone('.upload', {url: $('.upload').attr('data-url')});
    var uploads = [];
    dropzone.on('success', function (event, data) {
        uploads.push(data);
        console.log(uploads);
    });
});