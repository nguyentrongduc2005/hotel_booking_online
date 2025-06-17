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

//xử lý login và regis
Router::get('/login', 'AuthenController@login');
Router::post('/login', 'AuthenController@loginHandler');


Router::get('/regis', 'AuthenController@regis');
Router::post('/regis', 'AuthenController@regisHandler');


Router::get('/admin', 'DashboardController@show', ['AuthorMiddleware@author']);
