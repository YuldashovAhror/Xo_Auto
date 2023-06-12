<?php

use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\BrendController;
use App\Http\Controllers\Dashboard\CommentCompanyController;
use App\Http\Controllers\Dashboard\HomeSectionController;
use App\Http\Controllers\Dashboard\HomeVideoController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Dashboard\MachinetypeController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\StepBookController;
use App\Http\Controllers\Dashboard\StepController;
use App\Http\Controllers\Dashboard\UserCommentController;
use App\Http\Controllers\Dashboard\WorkController;
use Illuminate\Support\Facades\Route;

//Localization
// Route::get('/ru', function () {
//     session()->put('locale', 'ru');
//     return redirect()->back();
// })->name('languages');
// Route::get('/uz', function () {
//         session()->put('locale', 'uz');
//         return redirect()->back();
// })->name('languages');

//Front
Route::get('/', [\App\Http\Controllers\Front\FrontController::class, 'index'])->name('main');

//Dashboard
Route::group(['prefix' => 'dashboard'], function (){
    Route::name('dashboard.')->group(function (){
        Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('index');
        Route::resource('/slider', SliderController::class);
        Route::resource('/location', LocationController::class);
        Route::resource('/machinetype', MachinetypeController::class);
        Route::resource('/stepbook', StepBookController::class);
        Route::resource('/step', StepController::class);
        Route::resource('/commentcompany', CommentCompanyController::class);
        Route::resource('/usercomment', UserCommentController::class);
        Route::resource('/brend', BrendController::class);
        Route::resource('/homevideo', HomeVideoController::class);
        Route::resource('/homesection', HomeSectionController::class);
        Route::resource('/blog', BlogController::class);
        Route::resource('/work', WorkController::class);

    });
});


require __DIR__.'/auth.php';
