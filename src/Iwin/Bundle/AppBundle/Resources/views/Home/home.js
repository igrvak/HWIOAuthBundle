requirejs([
    'jquery',
    'underscore',
    'iwin-app/createfree/view',
    'iwin-app/profile/profile',
    'iwin-qual/task',
    'json!/taskapi',
    'iwin-advert/advertModel',
    'json!/advertapi',
    'domReady!',
], function ($, _, CreateFreeView, ProfileModel, TaskModel, taskData, AdvertModel, advertData) {
    'use strict';

    var cont = $('#page_target');

    var modelProfile = new ProfileModel(),
        modelAdvert = new AdvertModel(advertData),
        modelTask = new TaskModel(taskData);

    modelAdvert.set('profile', modelProfile);
    modelTask.set('profile', modelProfile);

    var view = new CreateFreeView({
        "model": {
            "advert":  modelAdvert,
            "task":    modelTask,
            "profile": modelProfile,
        },

        'el': cont,
    });
    view.render();
});