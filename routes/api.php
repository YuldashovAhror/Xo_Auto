<?php

use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Front\SericeSingleController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\AboutDiscriptionController;
use App\Http\Controllers\Front\AboutVideoController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\BrendController;
use App\Http\Controllers\Front\CarriersController;
use App\Http\Controllers\Front\LocationController;
use App\Http\Controllers\Front\MachineTypeController;
use App\Http\Controllers\Front\SliderController;
use App\Http\Controllers\Front\StepBookController;
use App\Http\Controllers\Front\StepController;
use App\Http\Controllers\Front\CommentCompanyController;
use App\Http\Controllers\Front\FeedbackController;
use App\Http\Controllers\Front\ForCarrierController;
use App\Http\Controllers\Front\HelpCenterController;
use App\Http\Controllers\Front\HomeSectionController;
use App\Http\Controllers\Front\HomeVideoController;
use App\Http\Controllers\Front\HowWorkController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\Front\ServiceController as FrontServiceController;
use App\Http\Controllers\Front\ServiceSectionController;
use App\Http\Controllers\Front\TeamController;
use App\Http\Controllers\Front\TypeController;
use App\Http\Controllers\Front\UserCommentController;
use App\Http\Controllers\Front\WorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/slider', [SliderController::class, 'index']);
Route::get('/location', [LocationController::class, 'index']);
Route::get('/machinetype', [MachineTypeController::class, 'index']);
Route::get('/stepbook', [StepBookController::class, 'index']);
Route::get('/step', [StepController::class, 'index']);
Route::get('/commentcompany', [CommentCompanyController::class, 'index']);
Route::get('/commentcompany/paginate', [CommentCompanyController::class, 'paginate']);
Route::get('/usercomment', [UserCommentController::class, 'index']);
Route::get('/brend', [BrendController::class, 'index']);
Route::get('/homevideo', [HomeVideoController::class, 'index']);
Route::get('/homesection', [HomeSectionController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{blog_id}', [BlogController::class, 'show']);
Route::get('/work', [WorkController::class, 'index']);
Route::get('/review', [ReviewController::class, 'index']);
Route::get('/aboutvideo', [AboutVideoController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/forcarriers', [ForCarrierController::class, 'index']);
Route::get('/carriers', [CarriersController::class, 'index']);
Route::get('/helpcenter', [HelpCenterController::class, 'index']);
Route::get('/team', [TeamController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store']);
Route::get('/type', [TypeController::class, 'index']);
Route::get('/howwork', [HowWorkController::class, 'index']);
Route::get('/service', [FrontServiceController::class, 'index']);
Route::get('/service/{service_id}', [FrontServiceController::class, 'show']);
Route::get('/servicesingle/{service_id}', [SericeSingleController::class, 'show']);
Route::get('/servicesection/{service_id}', [ServiceSectionController::class, 'show']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/aboutdiscription', [AboutDiscriptionController::class, 'index']);

