define([
    'lodash',
    'backbone',
    './routeView',
    './location',
    './locationCollection'
], function (_, Backbone, RouteView, LocationModel, LocationCollection) {
    'use strict';

    var viewId = 'iwin-app-location-route';

    var View = RouteView.extend({
        "initialize": function () {
            var args = _.toArray(arguments),
                options = args.shift() || {};

            options.model = new LocationCollection([
                options.model ? options.model : new LocationModel(),
            ]);

            options.isMultiple = false;

            args.unshift(options);


            RouteView.prototype.initialize.apply(this, args);
        },
    });

    return View;
});