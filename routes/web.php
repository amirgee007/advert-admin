<?php

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/', 'HomeController@index')->name('home');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


///////////////////Admin Routes//////////////////////////////////////////////
Route::group(['middleware' => ['auth']], function() {

    //Tickets Management system

    Route::get('/tickets/create', [
        'as' => 'tickets.create',
        'uses' => 'TicketController@create'
    ]);

    Route::get('/tickets/{ticket_id}', [
        'as' => 'tickets.show',
        'uses' => 'TicketController@show'
    ]);

    Route::post('/tickets/save', [
        'as' => 'tickets.save',
        'uses' => 'TicketController@save'
    ]);


    Route::get('/tickets', [
        'as' => 'tickets.get',
        'uses' => 'TicketController@index'
    ]);

    //Comments Management system

    Route::post('/tickets/comment', [
        'as' => 'tickets.comment',
        'uses' => 'CommentController@postComment'
    ]);



    Route::get('/tickets/close/{ticket_id}', [
        'as' => 'tickets.close',
        'uses' => 'TicketController@close'
    ]);


    Route::get('/tickets/urgent/{ticket_id}', [
        'as' => 'tickets.urgent',
        'uses' => 'TicketController@urgent'
    ]);



});



