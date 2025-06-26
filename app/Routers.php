<?php

// use app\core\Controller;

Router::get('/', 'HomeController@show', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);
//router trang list room
Router::get('/listroom', 'ListRoomController@index', [
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


///////////////////////////PAYMENT////////////////////////////////////////////////////
//submit từ trang detail room render ra form điền thông tin có
Router::post('/payment/{slug}', 'PaymentController@formInfo', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);
//submit từ trang form thông tin xử lý kiểm tra booking của người dùng và lưu vào render chọn method
Router::post('/payment/{slug}/handler', 'PaymentController@method', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);
//submit từ trang chọn method sử lý databasse để lưu vào bảng transaction thành cồng render ra trang thanks nếu không thì render ra fail
Router::post('/payment/{slug}/transaction', 'PaymentController@paymentMethodHandler', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

/////////////////////////////////////////////////////////////////////////////////////////////




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


//////////////////////rooms///////////////////////////////////////////
Router::get('/admin/rooms', 'AdminRoomsController@roomsShow', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

// filter rooms
Router::post('/admin/rooms', 'AdminRoomsController@roomFilter', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/rooms/add', 'AdminRoomsController@roomAdd', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
Router::post('/admin/rooms/edit', 'AdminRoomsController@roomEdit', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
Router::post('/admin/rooms/delete', 'AdminRoomsController@roomDelete', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);


///////////////////////////////////end rooms/////////////////////////////

///////////////////type rooms/////////////////////////////////////
Router::get('/admin/roomtypes', 'AdminTypeRoomsController@typeRoomsShow', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/roomtypes/add', 'AdminTypeRoomsController@typeRoomsAdd', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/roomtypes/edit', 'AdminTypeRoomsController@typeRoomsEdit', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/roomtypes/delete', 'AdminTypeRoomsController@typeRoomsDelete', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);


//////////////////end type rooms/////////////////////////////////////

//////////////////////amenities/////////////////////////////////////
Router::get('/admin/amenities', 'AdminAmenitiesController@amenitiesShow', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/amenities/add', 'AdminAmenitiesController@amenitiesAdd', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/amenities/edit', 'AdminAmenitiesController@amenitiesEdit', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/amenities/delete', 'AdminAmenitiesController@amenitiesDelete', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

/////////////////////end amenities/////////////////////////////////////

///////////////////////transactions/////////////////////////////////////

Router::get('/admin/transactions', 'AdminTransactionsController@transactionsShow', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/transactions', 'AdminTransactionsController@transactionFilter', [
    'AuthorMiddleware@checktoken',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);




///////////////////////end transactions/////////////////////////////////////