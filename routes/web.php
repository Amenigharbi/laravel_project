<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\loginController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Home',[HomeController::class,'home'])->name("Home");

Route::get('/about',[HomeController::class,'about'])->name('about');

Route::match(['get','post'],'/dashboard',[HomeController::class,'dashboard'])
->name('app_dashboard')
->Middleware('auth');//cette page est accessible aux utilisateurs authentifiés uniquement


Route::get('/logout',[loginController::class,'logout'])//path de logout
->name('app_logout');

Route::post('/emailExist',[loginController::class,'existEmail'])
->name('app_email_exist');

Route::match(['get','post'],'/activationCode/{token}',[loginController::class,'activationCode'])//lorsque tu n'entre pas le token dans l'adresse il ne va pas afficher la page de l'activation de l'account
->name('app_activation_code');

Route::get('/user_checker',[loginController::class,'userChecker'])
->name('app_user_checker');

Route::get('/resend_activation_code/{token}',[loginController::class,'resendActivation'])
->name('app_resend_code');
