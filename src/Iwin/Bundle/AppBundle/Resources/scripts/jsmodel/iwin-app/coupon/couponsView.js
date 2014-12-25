define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    'iwin-app/util/collectionView',
    'iwin-app/coupon/coupon',
    './couponTypeCollection',
    'select2/select2',
    'jquery/inputevent',
    'jqueryui',
    'backbone/modelbinder',
], function ($, _, Backbone, templating, CollectionView, CouponModel, CouponTypeCollection) {
    'use strict';

    var viewId = 'iwin-app-coupon-coupon',
        langDefault = window.$lang_default,
        langs = window.$langs;

    var View = CollectionView.extend({
        "langsSelected": langDefault,

        "couponTypes": null,

        "relatedModel": CouponModel,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function () {
            this.modelBinder = new Backbone.ModelBinder();

            this.model.on('change:type', this.render, this);

            this.couponTypes = new CouponTypeCollection();
            this.couponTypes.on('sync', this.render, this);
            this.couponTypes.fetch();

            CollectionView.prototype.initialize.apply(this, arguments);
        },

        "events": {
            "txtinput .limited-length": 'limitLength',
            "click .tabset a":          'selectTab',
        },

        "render": function () {
            this.$el.find('.select2').select2('destroy');

            this.$el.html(this.template(this.model, {
                "types":         this.couponTypes,
                "langs":         langs,
                "langsDef":      langDefault,
                "langsSelected": this.langsSelected,
            }));

            this.$el.find('.select2').select2({
                "minimumResultsForSearch": -1,
                "containerCssClass":       function () {
                    return $(this).attr('class');
                },
            });

            this.$el.find('.date-field').datepicker({
                "dateFormat": 'yy-mm-dd',
                "onSelect":   function () {
                    $(this).trigger('change');
                }
            });

            var bindings = _.merge({}, Backbone.ModelBinder.createDefaultBindings(this.el, 'name'), {
                "type": {
                    "selector":  "[name=type]",
                    "converter": _.bind(function (direction, value) {
                        return direction === 'ModelToView' ?
                            (value ? value.id : null) :
                            this.couponTypes.get(value);
                    }, this),
                },
            });
            this.modelBinder.bind(this.model.get('list[0]'), this.el, bindings);
            this.delegateEvents();

            this.$el.find('.limited-length').trigger('txtinput');
            return this;
        },

        "selectTab": function (e) {
            e.preventDefault();
            var obj = $(e.currentTarget);

            this.langsSelected = obj.data('lang');
            this.render();
        },

        "limitLength": function (e) {
            var obj = $(e.currentTarget),
                maxlen = obj.data('maxlength'),
                slen = obj.val().length;
            if (slen > maxlen) {
                slen = maxlen;
                obj.val(obj.val().substr(0, slen));
            }
            var len = '' + slen + '/' + maxlen;
            obj.closest('.value-box').find('.progress').text(len);
        },
    });

    return View;
});