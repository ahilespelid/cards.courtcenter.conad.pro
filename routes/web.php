<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::name('front.')->group(function(){   
//Route::match(['get', 'post'], '/', ['uses' => 'App\Http\Controllers\HomeController@index'])->name('home');    
Route::match(['get', 'post'], '/', ['uses' => 'App\Http\Controllers\IndexController@index'])->name('index');    
Route::match(['get', 'post'], '/save', ['uses' => 'App\Http\Controllers\IndexController@save'])->name('save');    
Route::match(['get', 'post'], '/report', ['uses' => 'App\Http\Controllers\IndexController@index'], function(){if(!$request->hasValidSignature()){abort(401);}})->name('report');    
//Route::match(['get', 'post'], '/addfields', ['uses' => 'App\Http\Controllers\HomeController@addfields'])->name('addfields');    
  
});