<?php

// use app\core\Controller;


Router::get('/', 'HomeController@show');
Router::get('/home/news', 'NewsController@show');

Router::get('/about/{id}', function () {
    echo 'about 111is runing';
});
Router::get('/about', function () {
    echo 'about is runing';
});

Router::post('/user', 'NewsController@index');
