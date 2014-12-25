define([
    'backbone',
    'backbone/relational',
    'backbone/modelbinder',
], function (Backbone) {
    'use strict';

    // Это позволяет корректно работать с select2
    void function (obj, name) {
        var old = obj[name];
        obj[name] = function (el, convertedValue) {
            old.apply(this, arguments);
            if (el.data('select2')) {
                el.select2('val', convertedValue);
            }
        };
    }(Backbone.ModelBinder.prototype, '_setElValue');

    Backbone.Relational.store.removeModelScope();
    Backbone.Relational.store.currentScope = {};
    Backbone.Relational.store.addModelScope(
        Backbone.Relational.store.currentScope
    );
    return Backbone.RelationalModel;
});