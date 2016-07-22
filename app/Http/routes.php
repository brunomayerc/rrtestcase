<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

/* ===================== View Routes ===================== */

Route::any('/', "ViewsController@index")->name('home');
Route::any('/search', "ViewsController@search")->name('search');
Route::any('/transactions', "ViewsController@transactions")->name('transactions');

/* //=================== View Routes ===================== */

/* ===================== API Routes ====================== */
Route::any('/api/import', "Api\ImportToolController@index")->name("api-import");

Route::any('/api/search', "Api\SearchController@search")->name("api-search");
Route::any('/api/search/typeahead', "Api\SearchController@typeahead")->name("api-typeahead");
/* //=================== API Routes ===================== */
