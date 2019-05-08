<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'web'], function () {
    Route::get('ticket', 'TicketController@index')->name('web.ticket');
    Route::get('ticket/adicionar', 'TicketController@create')->name('web.ticket.create');
    Route::post('ticket/adicionar', 'TicketController@store')->name('web.ticket.store');
    Route::get('ticket/show/{id}', 'TicketController@show')->name('web.ticket.show');
});
