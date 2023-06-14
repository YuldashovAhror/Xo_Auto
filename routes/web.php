<?php

use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\AboutVideoController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\BrendController;
use App\Http\Controllers\Dashboard\CommentCompanyController;
use App\Http\Controllers\Dashboard\HomeSectionController;
use App\Http\Controllers\Dashboard\HomeVideoController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Dashboard\MachinetypeController;
use App\Http\Controllers\Dashboard\ReviewController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\ServiceSectionController;
use App\Http\Controllers\Dashboard\ServiceSingleController;
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
        Route::resource('/service', ServiceController::class);
        Route::resource('/servicesingle', ServiceSingleController::class)->except('index', 'show', 'edit');
        Route::get('/service/{id}/servicesingle', [ServiceSingleController::class, 'index'])->name('servicesingle.index');
        Route::resource('/servicesection', ServiceSectionController::class)->except('index', 'show');
        Route::get('/service/{id}/servicesection', [ServiceSectionController::class, 'index'])->name('servicesections.index');
        Route::get('/service/{service}/servicesection/create', [ServiceSectionController::class, 'create'])->name('servicesections.create');
        Route::resource('/about', AboutController::class);
        Route::resource('/aboutvideo', AboutVideoController::class);
        Route::resource('/review', ReviewController::class);

    });
});


require __DIR__.'/auth.php';
