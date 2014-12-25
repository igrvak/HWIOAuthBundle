requirejs([
    'jquery',
    'google/maps'
], function ($, maps) {
    'use strict';

    //-- Marker ----------------------------------------------

    var marker = function (coords, image) {
        this._coords = coords;
        this._image = image;
    };

    marker.prototype.destroy = function () {
        if (this._mapMarker) {
            this._mapMarker.setMap(null)
        }
    };

    marker.prototype.setCoords = function (coords) {
        this._coords = coords;
    };

    marker.prototype.setMap = function (map) {
        this.destroy();
        this._map = map;
        var markerSettings = {
            position: (this._coords instanceof Array ?
                new maps.LatLng(this._coords[0], this._coords[1]) :
                this._coords),
            map: map
        };
        if (this._image) {
            markerSettings.icon = this._image;
        }
        this._mapMarker = new maps.Marker(markerSettings)
    };

    marker.prototype.refresh = function () {
        this.setMap(this._map);
    };

    //-- Map ----------------------------------------------

    var defaultMapOptions = {
        zoom: 5,
        center: new maps.LatLng(0, 0),
        mapTypeId: maps.MapTypeId.ROADMAP
    };

    var map = function (selectedCoords) {
        this._selectedCoords = selectedCoords;
    };

    map.prototype.show = function (element) {
        var mapOptions = $.extend({}, defaultMapOptions);
        if (this._selectedCoords) {
            mapOptions.center = this._selectedCoords instanceof  Array ?
                new maps.LatLng(this._selectedCoords[0], this._selectedCoords[1]) :
                this._selectedCoords;
        }

        this._map = new maps.Map(element, mapOptions);
        this._marker = new marker(this._selectedCoords);

        if (this._selectedCoords) {
            this._marker.setMap(this._map);
        }

        maps.event.addListener(this._map, 'click', function (event) {
            this._marker.setCoords(event.latLng);
            this._marker.refresh();
            this._selectedCoords = event.latLng;
            if (this._addressCallback){
                this.getAddress(this._addressCallback)                 
            }            
        }.bind(this));
    };
    
    map.prototype.setAddressCallback = function(callback){
        this._addressCallback = callback        
    };

    map.prototype.getAddress = function (callback) {
        (new maps.Geocoder()).geocode({
            latLng: this._selectedCoords instanceof  Array ?
                new maps.LatLng(this._selectedCoords[0], this._selectedCoords[1]) :
                this._selectedCoords
        }, function (addresses, status) {
            callback(status !== 'OK' ?
                null :
                addresses[0].formatted_address);
        });
    };  
    
    //-- page ---------------------
    
    var input = $('#input'),
        inputChangedByUser = false,
        positionChanged = function(address){
            if (inputChangedByUser){
                return;                
            }
            input.val(address)
        };
    input.keydown(function(){
        inputChangedByUser = true;
    });

    var newMap = new map([20, 20]);
    newMap.show(document.getElementById('map'));
    newMap.setAddressCallback(positionChanged);
});