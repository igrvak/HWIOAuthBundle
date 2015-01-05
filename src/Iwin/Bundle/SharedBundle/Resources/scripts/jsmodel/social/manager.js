define([
    'module',
    'lodash',
    'backbone',
], function (module, _, Backbone, undefined) {
    'use strict';

    var optsDef = {
        "autoload": true,
        "list":     [],
    };

    var Manager = function (optsIn) {
        _.extend(this, Backbone.Events);

        var opts = _.extend({}, optsDef, optsIn);

        this.socials = {};

        if (opts.autoload) {
            _.each(opts.list, function (name) {
                this.loadSocial(name);
            }, this);
        }
    };

    Manager.prototype.get = function (name) {
        if (!this.socials[name]) {
            throw 'Social ' + name + ' not loaded';
        }
        return this.socials[name];
    };
    Manager.prototype.getLoaded = function () {
        return _.keys(this.socials);
    };
    Manager.prototype.isLoaded = function (name) {
        return this.socials[name] !== undefined;
    };

    Manager.prototype.loadSocial = function (name) {
        requirejs(['social/module/' + name], _.bind(function (social) {
            this.trigger('social:preload');
            this.registerSocial(social);
        }, this));
    };
    Manager.prototype.registerSocial = function (Social) {
        var social = new Social(),
            name = social.getName();

        this.socials[name] = social;
        this.trigger('social:load', social);
        this.trigger('social:load:' + name);
    };


    return new Manager(module.config());
});