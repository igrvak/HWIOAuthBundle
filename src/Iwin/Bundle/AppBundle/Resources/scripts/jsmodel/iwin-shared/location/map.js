define([
    'jquery',
    'lodash',
    'google/maps'
], function ($, _, gmaps) {
    'use strict';

    var Marker = function (coords, image) {
        this._coords = coords;
        this._image = image;
    };

    Marker.prototype.destroy = function () {
        if (this._mapMarker) {
            this._mapMarker.setMap(null);
        }
    };

    Marker.prototype.setCoords = function (coords) {
        this._coords = coords;
    };

    Marker.prototype.setMap = function (map) {
        this.destroy();
        this._map = map;
        var markerSettings = {
            position: this._coords instanceof Array ?
                new gmaps.LatLng(this._coords[0], this._coords[1]) :
                this._coords,
            map:      map
        };
        if (this._image) {
            markerSettings.icon = this._image;
        }
        this._mapMarker = new gmaps.Marker(markerSettings);
    };

    Marker.prototype.refresh = function () {
        this.setMap(this._map);
    };

    //-- Map ----------------------------------------------

    var defaultMapOptions = {
        zoom:      4,
        center:    new gmaps.LatLng(0, 0),
        mapTypeId: gmaps.MapTypeId.ROADMAP
    };

    var Map = function (selectedCoords) {
        selectedCoords = selectedCoords || [20, 20];
        this._selectedCoords = new gmaps.LatLng(selectedCoords[0], selectedCoords[1]);
    };

    Map.prototype.center = function () {
        this._map.setCenter(this._selectedCoords);
    };

    Map.prototype.show = function (element) {
        var mapOptions = $.extend({}, defaultMapOptions);
        if (this._selectedCoords) {
            mapOptions.center = this._selectedCoords;
        }

        this._map = new gmaps.Map(element, mapOptions);
        this._marker = new Marker(this._selectedCoords);

        if (this._selectedCoords) {
            this._marker.setMap(this._map);
        }

        gmaps.event.addListener(this._map, 'click', function (event) {
            this._marker.setCoords(event.latLng);
            this._marker.refresh();
            this._selectedCoords = event.latLng;
            if (this._addressCallback) {
                this.getAddress(this._addressCallback);
            }
        }.bind(this));
    };

    Map.prototype.setAddressCallback = function (callback) {
        this._addressCallback = callback;
    };

    Map.prototype.getAddress = function (callback) {
        var geocoder = new gmaps.Geocoder(); // TODO: кешировать
        geocoder.geocode({
            latLng: this._selectedCoords,
        }, _.bind(function (addresses, status) {
            var address = status !== 'OK' ?
                null :
                addresses[0].formatted_address;
            callback.call(this, address, this._selectedCoords);
        }, this));
    };

    Map.prototype.repaint = function () {
        gmaps.event.trigger(this._map, 'resize');
        this.center();
    };

    return Map;
});