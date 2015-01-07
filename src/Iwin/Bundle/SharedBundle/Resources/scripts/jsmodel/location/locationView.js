define([
    'lodash',
    'backbone',
    './routeView',
    './locationCollection'
], function (_, Backbone, RouteView, LocationCollection) {
    'use strict';

    var viewId = 'iwin-app-location-route';

    var View = RouteView.extend({
        "initialize": function () {
            this.isMultiple = false;
            this.model = new LocationCollection([
                this.model,
            ]);

            RouteView.prototype.initialize.apply(this, arguments);
        },
    });

    return View;
});