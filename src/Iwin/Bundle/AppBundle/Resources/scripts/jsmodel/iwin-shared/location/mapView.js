define([
    'lodash',
    'backbone',
    'google/maps'
], function (_, Backbone, gmaps) {
    'use strict';

    var mapOpts = {
        zoom:      4,
        center:    null,
        mapTypeId: gmaps.MapTypeId.ROADMAP
    };

    var View = Backbone.View.extend({
        "map":     null,
        "marker":  null,
        "mapCont": null,

        "initialize": function () {
            this.mapCont = document.createElement('div');

            this.map = new gmaps.Map(this.mapCont, mapOpts);
            this.marker = new gmaps.Marker({
                "position": this.map.getCenter(),
                "map":      this.map,
            });
            this.updatePosition();

            gmaps.event.addListener(this.map, 'click', _.bind(function (event) {
                this.trigger('map:point', event.latLng);
            }, this));

            var geocoder = new gmaps.Geocoder();
            this.on('map:point', function (pos) {
                this.model.set({
                    "posLat":  pos.lat(),
                    "posLong": pos.lng(),
                });
                this.updatePosition();

                geocoder.geocode({
                    latLng: pos,
                }, _.bind(function (addresses, status) {
                    var address = status !== 'OK' ?
                        null :
                        addresses[0].formatted_address;
                    this.trigger('map:address', address, pos);
                }, this));
            });
            this.on('map:address', function (address) {
                this.model.set('address', address);
                console.log(9);
            });
        },

        "render": function () {
            this.$el.append(this.mapCont);

            this.$(this.mapCont).css({
                "width":  this.$el.width(),
                "height": this.$el.height(),
            });
            gmaps.event.trigger(this.map, 'resize');

            return this;
        },

        "updatePosition": function (model) {
            if (model) {
                this.model = model;
            }

            var pos = new gmaps.LatLng(
                this.model.get('posLat'),
                this.model.get('posLong')
            );
            this.map.setCenter(pos);
            this.marker.setPosition(pos);
        },
    });

    return View;
});