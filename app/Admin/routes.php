<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', CategoryController::class);
    $router->resource('banners', BannerController::class);
    $router->resource('pages', PageController::class);
    $router->resource('albums', AlbumController::class);
    $router->resource('podcasts', PodcastController::class);
    $router->resource('plans', PlanController::class);
    $router->resource('payments', PaymentController::class);
    $router->resource('songs', SongController::class);
});
