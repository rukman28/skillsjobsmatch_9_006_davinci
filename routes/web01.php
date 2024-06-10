<?php

/* System Includes */

use Illuminate\Support\Facades\Route;

/* App Includes */


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

Route::get("/", function () {
    return view("welcome");
});
Route::get("/big", function () {
    return view("welcome1");
});
