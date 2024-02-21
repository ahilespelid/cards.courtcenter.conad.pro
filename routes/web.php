<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::name('front.')->group(function(){   
Route::match(['get', 'post'], '/', ['uses' => 'App\Http\Controllers\HomeController@index'])->name('home');    
Route::match(['get', 'post'], '/save', ['uses' => 'App\Http\Controllers\HomeController@save'])->name('save');    
Route::match(['get', 'post'], '/up', ['uses' => 'App\Http\Controllers\HomeController@up'], function(){if(!$request->hasValidSignature()){abort(401);}})->name('up');    
//Route::match(['get', 'post'], '/addfields', ['uses' => 'App\Http\Controllers\HomeController@addfields'])->name('addfields');    
  
});