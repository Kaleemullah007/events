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

Route::get('/', 'FrontController@home')->name('home');
Route::get('/search', 'FrontController@search')->name('search');
Route::get('/about', 'FrontController@about')->name('about');
Route::get('/contact', 'FrontController@contact')->name('contact');
Route::get('/policy', 'FrontController@policy')->name('policy');
Route::get('/buy', 'FrontController@buy')->name('buy');
Route::get('/membership', 'FrontController@membership')->name('membership');
Route::get('/events-month/{date}', 'FrontController@way2_events_month');
Route::get('/success', 'FrontController@success');


Route::prefix('events')->group(function () {
	Route::get('add', 'FrontController@create')->name('addFrontEvent');
	Route::post('add', 'FrontController@save')->name('addFrontEvent');
	Route::post('states', 'EventController@getStates')->name('getStates');
	Route::post('cities', 'EventController@getCities')->name('getCities');

	Route::get('{id}/details/{name}', 'FrontController@getEventDetails')->name('getEventDetails');
	Route::post('addToWishList', 'FrontController@addToWishList')->name('addToWishList');
});

Route::post('events/states', 'EventController@getStates')->name('getStates');
Route::post('events/cities', 'EventController@getCities')->name('getCities');
Route::get('category/add', 'FrontController@addCategory');

Auth::routes();
Route::group(['prefix' => 'admin'], function () {

	Route::group(['middleware' => ['auth']], function() {
	
	    Route::get('/home', 'HomeController@index')->name('home');
	    Route::get('/profile', 'UserController@profile')->name('myProfile');
	    Route::post('updateProfile', 'UserController@save')->name('updateProfile');
	    Route::prefix('events')->group(function () {
	    	Route::get('listing', 'EventController@listing')->name('eventsListing');
	    	Route::get('fetchList', 'EventController@fetchList')->name('fetchList'); 
		    Route::get('add', 'EventController@create')->name('addEvent');
		    Route::get('{id}/edit', 'EventController@create')->name('editEvent');
		    Route::post('add', 'EventController@save')->name('saveEvent');
		    Route::post('delete', 'EventController@delete')->name('deleteEvent');
		    Route::post('changeStatus', 'EventController@changeStatus')->name('changeEventStatus');

		    Route::get('favouriteEventsListing', 'EventController@favouriteEventsListing')->name('favouriteEventsListing');
		    Route::get('fetchEventList', 'EventController@fetchFavouriteEvents')->name('fetchFavouriteEvents'); 
		    Route::post('deleteFavouriteEvent', 'EventController@deleteFavouriteEvent')->name('deleteFavouriteEvent');
		});
	    
	    Route::prefix('users')->group(function () {
		    Route::get('listing', 'UserController@listing')->name('usersListing');
		    Route::get('fetchList', 'UserController@fetchList')->name('fetchList'); 
		    Route::post('changeStatus', 'UserController@changeStatus')->name('changeUserStatus');
		});

		Route::prefix('publishers')->group(function () {
		    Route::get('listing', 'PublisherController@listing')->name('publisherListing');
		    Route::get('fetchList', 'PublisherController@fetchList')->name('fetchList'); 
		    Route::get('add', 'PublisherController@create')->name('addPublisher');
		    Route::get('{id}/edit', 'PublisherController@create')->name('editPublisher');
		    Route::post('add', 'PublisherController@save')->name('savePublisher');
		    Route::post('delete', 'PublisherController@delete')->name('deletePublisher');
		    Route::post('changeStatus', 'PublisherController@changeStatus')->name('changePublisherStatus');
		});
	});
});