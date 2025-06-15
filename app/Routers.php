<?php

// use app\core\Controller;

Router::get('/', 'HomeController@show', [
    // 'AuthenMiddleware@show',
    // 'AuthenMiddleware@show2'
]);
Router::get('/listroom', 'ListRoomController@show', [
    // 'AuthenMiddleware@show',
    // 'AuthenMiddleware@show2'
]);


Router::get('/detailroom/{slug}', 'DetailRoomController@index', [
    // 'AuthenMiddleware@show',
    // 'AuthenMiddleware@show2'
]);
