<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

/* ===================== View Routes ===================== */

Route::any('/', "ViewsController@index")->name('home');
Route::any('/search', "ViewsController@search")->name('search');

/* //=================== View Routes ===================== */

/* ===================== API Routes ====================== */
Route::any('/api/importdocs', "Api\ImportToolController@doctors")->name("api-import-doctors");
Route::any('/api/importprov', "Api\ImportToolController@providers")->name("api-import-providers");

Route::any('/api/search', "Api\SearchController@search")->name("api-search");
Route::any('/api/search/typeahead', "Api\SearchController@typeahead")->name("api-typeahead");
/* //=================== API Routes ===================== */
