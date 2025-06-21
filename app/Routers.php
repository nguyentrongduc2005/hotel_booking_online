<?php

// use app\core\Controller;

Router::get('/', 'HomeController@show', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

Router::get('/listroom', 'ListRoomController@show', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);


Router::get('/detailroom/{slug}', 'DetailRoomController@index', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser'
]);

Router::get('/services', 'ServicesController@show', [
    // 'AuthenMiddleware@show',
    // 'AuthenMiddleware@show2'
]);
Router::get('/services/{slug}', 'ServicesController@detail', [
    // 'AuthenMiddleware@show',
    // 'AuthenMiddleware@show2'
]);
//xử lý login và regis
Router::get('/login', 'AuthenController@login', []);
Router::post('/login', 'AuthenController@loginHandler', []);


Router::get('/regis', 'AuthenController@regis');
Router::post('/regis', 'AuthenController@regisHandler');
Router::get('/logout', 'AuthenController@logoutHandler', []);

//kéo dài phiên làm việc;
Router::get('/refeshToken', "AuthenController@refeshToken");

Router::get('/dashboard', 'DashboardController@show', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
