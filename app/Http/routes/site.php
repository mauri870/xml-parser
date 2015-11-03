<?php
// Site Routes
Route::get('/',['as'=>'home.index','uses'=>'ParseXmlController@index']);