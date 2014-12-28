define([
    'backbone',
    'social/api/linkedin',
], function (Backbone, IN) {
    'use strict';

    var LinkedIn = Backbone.Model.extend({
        getName:  function () {
            return 'linkedin';
        },
        isLogged: function (ifTrue, ifFalse) {
            if (IN.User.isAuthorized()) {
                ifTrue();
            }
            else {
                ifFalse();
            }
        },
        login:    function (ifSuccess, ifFail) {

            IN.User.authorize(function () {
                    ifSuccess();
                }
            );


        },
        getData:  function (callback) {
            IN.API.Profile('me')
                .fields(['id', 'firstName', 'lastName', 'pictureUrl', 'publicProfileUrl'])
                .result(function (response) {

                    callback({
                        id:    response.values[0].id,
                        name:  response.values[0].firstName + ' ' + response.values[0].lastName,
                        link:  response.values[0].publicProfileUrl,
                        photo: response.values[0].pictureUrl
                    });
                });
        }
    });


    return LinkedIn;
});