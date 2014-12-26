define([
    'jquery',
    'lodash',
    'backbone',
    'templating',
    './couponTypeCollection',
    'select2/select2',
    'jquery/inputevent',
    'jqueryui',
    'backbone/modelbinder',
    'css!config/inner-tabs',
], function ($, _, Backbone, templating, CouponTypeCollection) {
    'use strict';

    var viewId = 'iwin-app-coupon-coupon',
        langDefault = $('html').attr('lang'),
        langs = window.$langs;

    var View = Backbone.View.extend({
        "langsSelected": langDefault,

        "couponTypes": null,

        "modelBinder": undefined,
        "template":    templating.get(viewId),

        "initialize": function () {
            this.modelBinder = new Backbone.ModelBinder();

            this.model.on('change:type', this.render, this);

            this.couponTypes = new CouponTypeCollection();
            this.couponTypes.on('sync', this.render, this);
            this.couponTypes.fetch();
        },

        "events": {
            "txtinput .limited-length": 'limitLength',
            "click .tabset a":          'selectTab',
        },

        "render": function () {
            this.$el.find('.select2').select2('destroy');

            this.$el.html(this.template({
                "coupon":        this.model,
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
            this.modelBinder.bind(this.model, this.el, bindings);
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