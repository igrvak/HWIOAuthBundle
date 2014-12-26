/**
 * @author Bogdan Yurov
 *
 * Это вспомогательный вид для коллекции, нужен для того,
 * чтобы ModelBinder мог корректно подцепиться к дочерним элементам.
 * Работает просто - оборачивает коллекцию в еще одну модель.
 */
define([
    'lodash',
    'backbone',
    'iwin-app/util/basemodel',
], function (_, Backbone, BaseModel) {
    'use strict';

    var View = Backbone.View.extend({
        "relatedModel": null,
        "relatedKey":   'list',

        "initialize": function () {
            var Model = BaseModel.extend({
                "relations": [{
                    "type":         Backbone.HasMany,
                    "key":          this.relatedKey,
                    "relatedModel": this.relatedModel,
                }],
            });

            var model = this.model;
            this.model = new Model();
            this.model.set(this.relatedKey, model);

            this.template = _.bind(function (supr) {
                return _.bind(function () {
                    return supr({
                        'list': this.model.get(this.relatedKey),
                    });
                }, this);
            }, this)(this.template);
        },
    });

    return View;
});