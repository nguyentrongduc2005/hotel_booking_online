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

Router::get('/news/{id}', 'NewsController@show', [
    'AuthenMiddleware@show',
    'AuthenMiddleware@show2'
]);

Router::get('/home/news', function () {
    echo 'home news is running';
}, []);

Router::get('/about/{id}', 'HomeController@show', [
    'AuthenMiddleware@show',
    'AuthenMiddleware@show2'
]);

Router::get('/about', 'HomeController@show', [
    'AuthenMiddleware@show',
    'AuthenMiddleware@show2'
]);

Router::post('/user', 'NewsController@show', [
    'AuthenMiddleware@show',
    'AuthenMiddleware@show2'
]);