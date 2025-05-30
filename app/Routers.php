<?php

// use app\core\Controller;


Router::get('/', 'HomeController@show', [
    'AuthenMiddleware@show',
    'AuthenMiddleware@show2'
]);
Router::get('/home/news', function () {
    echo 'home news is running';
}, []);

Router::get('/about/{id}', 'HomeController@show');
Router::get(
    '/about',
    'HomeController@show'
);

Router::post('/user', 'NewsController@show', [
    'AuthenMiddleware@show',
    'AuthenMiddleware@show2'
]);
