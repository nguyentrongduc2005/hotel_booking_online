<?php

// use app\core\Controller;

Router::get('/', 'HomeController@show', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);
//router trang list room
Router::get('/listroom', 'ListRoomController@index', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);


//router trang detail room
Router::get('/detailroom/{slug}', 'DetailRoomController@index', [
    'AuthorMiddleware@checkSession',
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
    'AuthorMiddleware@checkSession',
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
/////////////////////////popup///////////////////////////////////////////////////////

Router::get('/user', 'PopUpController@showUser', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);
Router::post('/user', 'PopUpController@handlerEditUser', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

Router::post('/user/changePass', 'PopUpController@changePasswordUser', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

Router::get('/user/reservations', 'PopUpController@myReservationHandler', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

Router::post('/user/reservations', 'PopUpController@myReservationHandler', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

Router::post('/user/reservations/cancel', 'PopUpController@myReservationCancel', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

Router::get('/user/histories', 'PopUpController@historyHandler', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

Router::post('/user/histories', 'PopUpController@historyHandler', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

Router::get('/user/transactions', 'PopUpController@getTransaction', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);
Router::post('/user/transactions', 'PopUpController@getTransaction', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);



/////////////////////////////end popup///////////////////////////////////////////////

///////////////////////////PAYMENT////////////////////////////////////////////////////
//submit từ trang detail room render ra form điền thông tin có
Router::get('/payment/{slug}', 'PaymentController@formInfo', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);
Router::post('/payment/{slug}', 'PaymentController@formInfoHandler', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

//submit từ trang form thông tin xử lý kiểm tra booking của người dùng và lưu vào render chọn method
Router::get('/paymentMethod/{slug}', 'PaymentController@getMethod', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);
Router::post('/paymentMethod/{slug}', 'PaymentController@paymentMethodHandler', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);
//submit từ trang chọn method sử lý databasse để lưu vào bảng transaction thành cồng render ra trang thanks nếu không thì render ra fail

Router::get('/paymentSuccess', 'PaymentController@paymentSuccess', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleUser',
]);

/////////////////////////////////////////////////////////////////////////////////////////////




////ADMIN//////////////////////////////////////////////////////////////////////////////////
Router::get('/dashboard', 'DashboardController@show', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/dashboard/confirm', 'DashboardController@bookingConfirm', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::get('/dashboard/checkin', 'DashboardController@checkinShow', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
Router::post('/dashboard/checkin', 'DashboardController@checkinHandler', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::get('/dashboard/checkout', 'DashboardController@checkoutShow', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
Router::post('/dashboard/checkout', 'DashboardController@checkoutHandler', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);



//////////////////////rooms///////////////////////////////////////////
Router::get('/admin/rooms', 'AdminRoomsController@roomsShow', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

// filter rooms
Router::post('/admin/rooms', 'AdminRoomsController@roomFilter', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/rooms/add', 'AdminRoomsController@roomAdd', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
Router::post('/admin/rooms/edit', 'AdminRoomsController@roomEdit', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
Router::post('/admin/rooms/delete', 'AdminRoomsController@roomDelete', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);


///////////////////////////////////end rooms/////////////////////////////

///////////////////type rooms/////////////////////////////////////
Router::get('/admin/roomtypes', 'AdminRoomsController@typeRoomsShow', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/roomtypes/add', 'AdminRoomsController@typeRoomsAdd', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/roomtypes/edit', 'AdminRoomsController@typeRoomsEdit', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/roomtypes/delete', 'AdminRoomsController@typeRoomsDelete', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);


//////////////////end type rooms/////////////////////////////////////

//////////////////////amenities/////////////////////////////////////
Router::get('/admin/amenities', 'AdminRoomsController@amenitiesShow', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/amenities/add', 'AdminRoomsController@amenitiesAdd', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/amenities/edit', 'AdminRoomsController@amenitiesEdit', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/amenities/delete', 'AdminRoomsController@amenitiesDelete', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

/////////////////////end amenities/////////////////////////////////////

//////////////////////Booking and historyBooking/////////////////////////////////////
Router::get('/admin/Booking/allbookings', 'AdminBookingController@allIndex', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
router::get('/admin/Booking/historybookings', 'AdminBookingController@historyIndex', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
//////////////////////Admin/////////////////////////////////////
Router::get('/admin/accountAdmin', 'AdminAccountController@index', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::get('/admin/private', 'AdminAccountController@privateAdmin', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@author',
    'AuthorMiddleware@checkRoleAdmin',
]);
// Users
Router::get('/admin/customers/users', 'AdminCustomersController@users', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/customers/users/delete/:id', 'AdminCustomersController@deleteUser', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@checkRoleAdmin',
]);

// Guests
Router::get('/admin/customers/guests', 'AdminCustomersController@guests', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::post('/admin/customers/guests/delete/:id', 'AdminCustomersController@deleteGuest', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@checkRoleAdmin',
]);

Router::get('/admin/services', 'AdminServicesController@index', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@checkRoleAdmin',
]);

// Thêm
Router::post('/admin/services/create', 'AdminServicesController@create', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@checkRoleAdmin',
]);

// Sửa
Router::post('/admin/services/update/:id', 'AdminServicesController@update', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@checkRoleAdmin',
]);

// Xoá
Router::post('/admin/services/delete/:id', 'AdminServicesController@delete', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@checkRoleAdmin',
]);

//Không thèm làm router cho toi luôn mà!!!!!
Router::get('/admin/transactions', 'AdminTransactionsController@transactionsShow', [
    'AuthorMiddleware@checkSession',
    'AuthorMiddleware@checkRoleAdmin',
]);