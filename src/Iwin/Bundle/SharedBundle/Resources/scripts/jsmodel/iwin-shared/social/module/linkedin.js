define([
    'backbone',
    'iwin-shared/social/api/linkedin',
], function (Backbone, IN) {
    'use strict';

    var LinkedIn = Backbone.Model.extend({
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
            IN.API.Profile('me').result(function (response) {

                console.log(response);
                callback({
                    id:    response.values[0].id,
                    name:  response.values[0].firstName + ' ' + response.values[0].lastName,
                    link:  '',
                    photo: response.values[0].pictureUrl
                });
            });
        }
    });


    return LinkedIn;
});