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
    'util/basemodel',
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
                return _.bind(function (obj, extra) {
                    return supr(_.merge(_.object([[
                        this.relatedKey,
                        this.model.get(this.relatedKey)
                    ]]), extra || {}));
                }, this);
            }, this)(this.template);
        },

        "addItemEmpty": function () {
            this.model.get('list').add(new this.relatedModel());
        },
    });

    return View;
});