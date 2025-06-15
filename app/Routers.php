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

Router::get('/detailroom/{id}', 'DetailRoomController@show', [
    'AuthenMiddleware@show',
    'AuthenMiddleware@show2'
]);
Router::get('/detailroom', 'DetailRoomController@show', [
    // 'AuthenMiddleware@show',
    // 'AuthenMiddleware@show2'
]);
