<?php

Route::get('/facebook', 'SocialiteController@redirectToFacebook')->name('facebook');
Route::get('/facebook/callback', 'SocialiteController@handleFacebookCallback');

Route::get('/linkedin', 'SocialiteController@redirectToLinkedin')->name('linkedin');
Route::get('/linkedin/callback', 'SocialiteController@handleLinkedinCallback');

Route::get('/google', 'SocialiteController@redirectToGoogle')->name('google');
Route::get('/google/callback', 'SocialiteController@handleGoogleCallback');

Route::get('/github', 'SocialiteController@redirectToGitHub')->name('github');
Route::get('/github/callback', 'SocialiteController@handleGitHubCallback');

Route::get('/', 'WelcomeController@home_page')->name('home_page');
Route::get('/new_user', 'WelcomeController@new_user')->name('new_user');
Route::post('/post_new_user', 'WelcomeController@post_new_user')->name('post_new_user');
Route::get('/active_account', 'WelcomeController@active_account')->name('active_account');
Route::get('/blog', 'WelcomeController@blog')->name('blog');
Route::get('/blog_view/{slug?}/{id?}', 'WelcomeController@blog_view')->name('blog_view');
Route::get('/like_post', 'WelcomeController@like_post')->name('like_post');
Route::get('/travelez', 'WelcomeController@travelez')->name('travel');
Route::get('/travel_view/{slug?}/{id?}', 'WelcomeController@travel_view')->name('travel_view');
Route::get('/profile/{email?}/{id?}', 'WelcomeController@profile')->name('profile');
Route::get('/countries', 'WelcomeController@countries')->name('countries');
Route::get('/contact_us', 'WelcomeController@contact_us')->name('contact_us');
Route::post('/post_contact_us', 'WelcomeController@post_contact_us')->name('post_contact_us');
Route::post('/newslatter', 'WelcomeController@newslatter')->name('newslatter');
Route::get('/resident', 'WelcomeController@resident')->name('resident');

Route::get('/tourism_companies', 'TourismCompaniesController@index')->name('tourism_companies');
Route::get('/tourism_companies/{slug?}/{id?}', 'TourismCompaniesController@index_view')->name('tourism_companies_view');

Route::group(['middleware'=>'auth'],function (){
    Route::post('/comment_post','WelcomeController@comment_post')->name('comment_post');
    Route::post('message_travel','WelcomeController@message_travel')->name('message_travel');
    Route::post('send_message','WelcomeController@send_message')->name('send_message');
    Route::post('read_send_message','WelcomeController@read_send_message')->name('read_send_message');
    Route::post('read_it_message','WelcomeController@read_it_message')->name('read_it_message');
    Route::get('notification','WelcomeController@notification')->name('notification');
    Route::post('update_info','WelcomeController@update_info')->name('update_info');
    Route::post('continue_choice_your_travel','WelcomeController@continue_choice_your_travel')->name('continue_choice_your_travel');
    Route::post('btn_ok_cancel_choice','WelcomeController@btn_ok_cancel_choice')->name('btn_ok_cancel_choice');
    Route::post('Star_Choice_your_travel','WelcomeController@Star_Choice_your_travel')->name('Star_Choice_your_travel');
    Route::post('alerts_resident','WelcomeController@alerts_resident')->name('alerts_resident');
    Route::get('my_orders','WelcomeController@order')->name('my_orders');
    Route::post('my_orders_get_data','WelcomeController@my_orders_get_data')->name('my_orders_get_data');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin
Route::group(['prefix' => 'dashboard','middleware'=>'admin'],function (){
    Route::get('/index','Admin\DashboardController@index')->name('dashboard_admin.index');
});

Route::group(['prefix' => 'dashboard/users','middleware'=>'admin'],function (){
    Route::get('/','Admin\UsersController@index')->name('users.index');
    Route::get('/getdataid/{id?}','Admin\UsersController@getdataid')->name('users.getdataid');
    Route::get('/deleted/{id?}','Admin\UsersController@deleted')->name('users.deleted');
    Route::post('/getdata', 'Admin\UsersController@getdata')->name('users.getdata');
    Route::post('/postdata', 'Admin\UsersController@postdata')->name('users.postdata');
    Route::get('/confirm_email', 'Admin\UsersController@confirm_email')->name('users.confirm_email');
});

Route::group(['prefix' => 'dashboard/countries','middleware'=>'admin'],function (){
    Route::get('/','Admin\CountriesController@index')->name('countries.index');
    Route::get('/getdataid/{id?}','Admin\CountriesController@getdataid')->name('countries.getdataid');
    Route::get('/deleted/{id?}','Admin\CountriesController@deleted')->name('countries.deleted');
    Route::post('/getdata', 'Admin\CountriesController@getdata')->name('countries.getdata');
    Route::post('/postdata', 'Admin\CountriesController@postdata')->name('countries.postdata');
});

Route::group(['prefix' => 'dashboard/travel','middleware'=>'admin'],function (){
    Route::get('/','Admin\TravelController@index')->name('travel.index');
    Route::get('/add_edit','Admin\TravelController@add_edit')->name('travel.add_edit');
    Route::get('/getdataid/{id?}','Admin\TravelController@getdataid')->name('travel.getdataid');
    Route::get('/deleted/{id?}','Admin\TravelController@deleted')->name('travel.deleted');
    Route::post('/getdata', 'Admin\TravelController@getdata')->name('travel.getdata');
    Route::post('/postdata', 'Admin\TravelController@postdata')->name('travel.postdata');
    Route::get('/countries', 'Admin\TravelController@countries')->name('travel.countries');


    Route::get('/attachments/{id?}', 'Admin\TravelController@attachments')->name('travel.attachments');
    Route::get('/file_deleted/{id?}', 'Admin\TravelController@file_deleted')->name('travel.file_deleted');
    Route::get('/file_deleted_by_id/{id?}', 'Admin\TravelController@file_deleted_by_id')->name('travel.file_deleted_by_id');
    Route::post('/travel_file', 'Admin\TravelController@travel_file')->name('travel.travel_file');

});

Route::group(['prefix' => 'dashboard/post','middleware'=>'admin'],function (){
    Route::get('/','Admin\PostController@index')->name('post.index');
    Route::get('/getdataid/{id?}','Admin\PostController@getdataid')->name('post.getdataid');
    Route::get('/deleted/{id?}','Admin\PostController@deleted')->name('post.deleted');
    Route::post('/getdata', 'Admin\PostController@getdata')->name('post.getdata');
    Route::post('/postdata', 'Admin\PostController@postdata')->name('post.postdata');
    Route::get('/countries', 'Admin\PostController@countries')->name('post.countries');
});

Route::group(['prefix' => 'dashboard/setting','middleware'=>'admin'],function (){
    Route::get('/','Admin\SettingController@index')->name('setting_admin.index');
    Route::get('/getdata','Admin\SettingController@getdata')->name('setting_admin.getdata');
    Route::post('/postdata', 'Admin\SettingController@postdata')->name('setting_admin.postdata');
});

Route::group(['prefix' => 'dashboard/feedback','middleware'=>'admin'],function (){
    Route::get('/','Admin\FeedBackController@index')->name('feedback.index');
    Route::post('/getdata', 'Admin\FeedBackController@getdata')->name('feedback.getdata');
    Route::get('/getdataid/{id?}','Admin\FeedBackController@getdataid')->name('feedback.getdataid');
    Route::get('/deleted/{id?}','Admin\FeedBackController@deleted')->name('feedback.deleted');
    Route::get('/deleted_all','Admin\FeedBackController@deleted_all')->name('feedback.deleted_all');
});

Route::group(['prefix' => 'dashboard/newsletter','middleware'=>'admin'],function (){
    Route::get('/','Admin\NewsletterController@index')->name('newsletter.index');
    Route::post('/getdata', 'Admin\NewsletterController@getdata')->name('newsletter.getdata');
    Route::get('/getdataid/{id?}','Admin\NewsletterController@getdataid')->name('newsletter.getdataid');
    Route::get('/deleted/{id?}','Admin\NewsletterController@deleted')->name('newsletter.deleted');
    Route::get('/deleted_all','Admin\NewsletterController@deleted_all')->name('newsletter.deleted_all');
});

Route::group(['prefix' => 'dashboard/partner','middleware'=>'admin'],function (){
    Route::get('/','Admin\PartnerController@index')->name('partner.index');
    Route::get('/getdataid/{id?}','Admin\PartnerController@getdataid')->name('partner.getdataid');
    Route::get('/deleted/{id?}','Admin\PartnerController@deleted')->name('partner.deleted');
    Route::post('/getdata', 'Admin\PartnerController@getdata')->name('partner.getdata');
    Route::post('/postdata', 'Admin\PartnerController@postdata')->name('partner.postdata');
});

Route::group(['prefix' => 'dashboard/comment_users','middleware'=>'admin'],function (){
    Route::get('/','Admin\CommentUserController@index')->name('comment_users.index');
    Route::get('/getdataid/{id?}','Admin\CommentUserController@getdataid')->name('comment_users.getdataid');
    Route::post('/getdata', 'Admin\CommentUserController@getdata')->name('comment_users.getdata');
    Route::get('/deleted/{id?}','Admin\CommentUserController@deleted')->name('comment_users.deleted');
    Route::get('/approve', 'Admin\CommentUserController@approve')->name('comment_users.approve');
});


Route::group(['prefix' => 'dashboard/tourism_companies','middleware'=>'admin'],function (){
    Route::get('/','Admin\TourismCompaniesController@index')->name('tourism_companies.index');
    Route::get('/add_edit','Admin\TourismCompaniesController@add_edit')->name('tourism_companies.add_edit');
    Route::get('/getdataid/{id?}','Admin\TourismCompaniesController@getdataid')->name('tourism_companies.getdataid');
    Route::get('/deleted/{id?}','Admin\TourismCompaniesController@deleted')->name('tourism_companies.deleted');
    Route::post('/getdata', 'Admin\TourismCompaniesController@getdata')->name('tourism_companies.getdata');
    Route::post('/postdata', 'Admin\TourismCompaniesController@postdata')->name('tourism_companies.postdata');
    Route::get('/countries', 'Admin\TourismCompaniesController@countries')->name('tourism_companies.countries');


    Route::get('/attachments/{id?}', 'Admin\TourismCompaniesController@attachments')->name('tourism_companies.attachments');
    Route::get('/file_deleted/{id?}', 'Admin\TourismCompaniesController@file_deleted')->name('tourism_companies.file_deleted');
    Route::get('/file_deleted_by_id/{id?}', 'Admin\TourismCompaniesController@file_deleted_by_id')->name('tourism_companies.file_deleted_by_id');
    Route::post('/tourism_companies_file', 'Admin\TourismCompaniesController@tourism_companies_file')->name('tourism_companies.tourism_companies_file');

});