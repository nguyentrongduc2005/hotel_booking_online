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

//router trang detail room
Router::get('/detailroom/{slug}', 'DetailRoomController@index', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser'
]);
//router trang services
Router::get('/services', 'ServicesController@show', [
    // 'AuthenMiddleware@show',
    // 'AuthenMiddleware@show2'
]);
//router trang service detail
Router::get('/services/{slug}', 'ServicesController@detail', [
    // 'AuthenMiddleware@show',
    // 'AuthenMiddleware@show2'
]);
//router trang liên lạc
Router::get('/contact', 'ContactController@show', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

//xử lý login và regis
Router::get('/login', 'AuthenController@login', []);
Router::post('/login', 'AuthenController@loginHandler', []);

Router::get('/regis', 'AuthenController@regis');
Router::post('/regis', 'AuthenController@regisHandler');
Router::get('/logout', 'AuthenController@logoutHandler', []);

//kéo dài phiên làm việc;
Router::get('/refeshToken', "AuthenController@refeshToken");


///router xử lý thanh toán
Router::get('/payment', 'PaymentController@show', []);




////ADMIN//////////////////////////////////////////////////////////////////////////////////
Router::get('/dashboard', 'DashboardController@show', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/dashboard/confirm', 'DashboardController@bookingConfirm', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::get('/dashboard/checkin', 'DashboardController@checkinShow', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
Router::post('/dashboard/checkin', 'DashboardController@checkinHandler', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::get('/dashboard/checkout', 'DashboardController@checkoutShow', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
Router::post('/dashboard/checkout', 'DashboardController@checkoutHandler', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
