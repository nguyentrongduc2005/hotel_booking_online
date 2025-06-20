<?php

// use app\core\Controller;

Router::get('/', 'HomeController@show', ['AuthorMiddleware@checktoken']);
Router::get('/listroom', 'ListRoomController@show', [
    // 'AuthenMiddleware@show',
    // 'AuthenMiddleware@show2'
]);


Router::get('/detailroom/{slug}', 'DetailRoomController@index', [
    'AuthorMiddleware@checktoken'
]);

//xử lý login và regis
Router::get('/login', 'AuthenController@login');
Router::post('/login', 'AuthenController@loginHandler');


Router::get('/regis', 'AuthenController@regis');
Router::post('/regis', 'AuthenController@regisHandler');
Router::post('/logout', 'AuthenController@logoutHandler');

//kéo dài phiên làm việc;
Router::post('/refeshToken', "AuthenController@refeshToken");

Router::get('/dashboard', 'DashboardController@show', ['AuthorMiddleware@checktoken']);
