<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect('/fresher-king');
});

Route::get('fresher-king', function () {
    $data = ['view_name' => 'fresher_king', 'item' => 1];
    return view('home', compact('data'));
});

Route::get('fresher-queen', function() {
    $data = ['view_name' => 'fresher_queen', 'item' => 2];
    return view('home', compact('data'));
});

Route::get('whole-king', function() {
    $data = ['view_name' => 'whole_king', 'item' => 3];
    return view('home', compact('data'));
});

Route::get('whole-queen', function() {
    $data = ['view_name' => 'whole_queen', 'item' => 4];
    return view('home', compact('data'));
});


Route::get('ajaxQRCodeValidationRequest/{contestant_id}/{qr_code}', 'AjaxRequestController@validate_qr_code');

Route::get('ajaxDatabaseUpdateRequest/{user_id}/{contestant_id}', 'AjaxRequestController@vote_up');

Route::get('admin/result', 'AdminController@index');

Route::get('admin/start/ram/voting', 'AdminController@start_voting');

Route::get('restart', function() {
	DB::table('votes') -> truncate();
});
