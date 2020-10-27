<?php

use Illuminate\Routing\Router;
//use App\Admin\Controllers\FileBasicsController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resources([
        'file/basics'           => FileBasicsController::class,
        'file/educations'       => FileEducationsController::class,
        'file/workexperience'   => FileWorkExperienceController::class,
    ]);

});
