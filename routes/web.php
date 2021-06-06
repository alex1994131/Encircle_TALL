<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TrustController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\TestTypeController;
use App\Http\Controllers\KeydateController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PatientMessageController;
use App\Http\Controllers\PatientCampaignController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('trusts', TrustController::class);
        Route::resource('users', UserController::class);
        Route::get('user/editProfile', [UserController::class, 'editProfile'])->name('users.editProfile'); 
        Route::post('user/avatarUpload', [UserController::class, 'avatarUpload'])->name('user.avatarUpload');
        Route::post('user/updateProfile', [UserController::class, 'updateProfile'])->name('user.update.profile');
        Route::post('user/updatePassword', [UserController::class, 'updatePassword'])->name('user.update.profile.password');

        Route::resource('campaigns', CampaignController::class, ['except' => ['update']]);

        Route::post('campaigns/{campaign}', [CampaignController::class, "update"])->name('campaigns.update');

        Route::resource('patients', PatientController::class);
        Route::post('patients/getCampaignsByFilter', [PatientController::class, 'getCampaignsByFilter'])->name('patients.getCampaignsByFilter'); 
        Route::post('patients/getKeydatesByFilter', [PatientController::class, 'getKeydatesByFilter'])->name('patients.getKeydatesByFilter'); 
        Route::get('patients/edit_campaign/{campaign}/{patient}', [PatientController::class, "campaignEdit"])->name('patients.campaign.edit');
        Route::post('patients/update_campaign/{campaign}/{patient}', [PatientController::class, "campaignUpdate"])->name('patients.campaign.update');
        Route::post('patients/addResultData', [PatientController::class, 'addResultData'])->name('patients.addResultData'); 
        Route::post('patients/addNextAppointment', [PatientController::class, 'addNextAppointment'])->name('patients.addNextAppointment'); 
        Route::post('patients/addResultData', [PatientController::class, 'addResultData'])->name('patients.addResultData'); 
        Route::post('patients/editKeydateAptDate', [PatientController::class, 'editKeydateAptDate'])->name('patients.editKeydateAptDate'); 
        Route::post('patients/editKeydateAptTime', [PatientController::class, 'editKeydateAptTime'])->name('patients.editKeydateAptTime'); 


        Route::resource('keydates', KeydateController::class);
        Route::resource('outbounds', OutboundController::class);
        
        Route::resource('libraries', LibraryController::class);
        Route::post('libraries/getMessages', [LibraryController::class, 'getMessages'])->name('libraries.getMessages'); 
        Route::post('libraries/getPatientMessages', [LibraryController::class, 'getPatientMessages'])->name('libraries.getPatientMessages'); 
        
        Route::resource('test-types', TestTypeController::class);
        Route::resource('patient-messages', PatientMessageController::class);
        Route::resource('patient-campaigns', PatientCampaignController::class);

        Route::post('campaigns/getSubConditions', [CampaignController::class, 'getSubConditions'])->name('campaigns.getSubConditions');  
        Route::post('patients/getSubConditions', [PatientController::class, 'getSubConditions'])->name('patients.getSubConditions'); 
        Route::post('patients/convertToArchive', [PatientController::class, 'convertToArchive'])->name('patients.convertToArchive'); 
        Route::get('patients/editArchive/{patient}', [PatientController::class, 'edit_archive'])->name('patients.edit_archive'); 
        Route::post('patients/duplicateArchive', [PatientController::class, 'duplicateArchive'])->name('patients.duplicateArchive');
    });
