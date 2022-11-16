<?php

use Carbon\Carbon;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdultController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendSMSController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\PregnantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThirdDoseController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\SecondDoseController;
use App\Http\Controllers\SeniorCitizenController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\VaccineRolloutController;
use App\Http\Controllers\InfantImmunizationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SchoolAgedChildrenController;
use App\Http\Controllers\RestoreImmunizationController;
use App\Http\Controllers\UserActivityLogController;
use App\Models\Immunization;
use App\Models\UserActivityLog;


// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/infant_immunizations/administered',[InfantImmunizationController::class,'administered'])->name('infant.administered');
    Route::post('/school_aged_immunizations/administered',[SchoolAgedChildrenController::class,'administered'])->name('school_aged.administered');
    Route::post('/pregnant_immunizations/administered',[PregnantController::class,'administered'])->name('pregnant.administered');
    Route::post('/adult_immunizations/administered',[AdultController::class,'administered'])->name('adult.administered');
    Route::post('/senior_citizen_immunizations/administered',[SeniorCitizenController::class,'administered'])->name('senior_citizen.administered');
    Route::post('/infant_immunizations/multiAction',[InfantImmunizationController::class,'multiAction'])->name('infantMultiAction');
    Route::post('/school_aged_immunizations/multiAction',[SchoolAgedChildrenController::class,'multiAction'])->name('schoolAgedMultiAction');
    Route::post('/pregnant_immunizations/multiAction',[PregnantController::class,'multiAction'])->name('pregnantMultiAction');
    Route::post('/adult_immunizations/multiAction',[AdultController::class,'multiAction'])->name('adultMultiAction');
    Route::post('/senior_citizen_immunizations/multiAction',[SeniorCitizenController::class,'multiAction'])->name('seniorMultiAction');
    Route::resource('infant_immunizations', InfantImmunizationController::class)->except(['create', 'show', 'edit']);
    Route::resource('school_aged_immunizations', SchoolAgedChildrenController::class)->except(['create', 'show', 'edit']);
    Route::resource('pregnant_immunizations', PregnantController::class)->except(['create', 'show', 'edit']);
    Route::resource('adult_immunizations', AdultController::class)->except(['create','show', 'edit']);
    Route::resource('senior_citizen_immunizations', SeniorCitizenController::class)->except(['create', 'show', 'edit']);

    Route::get('/my_profile', [ProfileController::class, 'index'])->name('my_profile.index');
    Route::post('/change_profile_picture', [ProfileController::class, 'setProfilePicture'])->name('profile.setProfilePicture');
    Route::post('/change_profile', [ProfileController::class, 'changeProfile'])->name('profile.changeProfile');
    Route::post('/change_password',[ProfileController::class, 'changePassword'])->name('profile.changePassword');


    /* Second Dose */
    Route::get('/infant_second_dose', [SecondDoseController::class, 'infantSecondDoseIndex'])->name('infant_second_dose');
   
    Route::put('/infant_second_dose/edit_second_dose_immunization/{id}', [SecondDoseController::class, 'editInfantImmunization'])->name('editInfantImmunization');

    Route::get('/school_aged_children_second_dose', [SecondDoseController::class, 'SchoolAgedSecondDoseIndex'])->name('school_aged_second_dose');
    
    Route::put('/school_aged_second_dose/edit_second_dose_immunization/{id}', [SecondDoseController::class, 'editSchoolAgedImmunization'])->name('editSchoolAgedImmunization');

    Route::get('/pregnant_second_dose', [SecondDoseController::class, 'pregnantSecondDoseIndex'])->name('pregnant_second_dose');
    
    Route::put('/pregnant_second_dose/edit_second_dose_immunization/{id}', [SecondDoseController::class, 'editPregnantImmunization'])->name('editPregnantImmunization');

    Route::get('/adult_second_dose', [SecondDoseController::class, 'adultSecondDoseIndex'])->name('adult_second_dose');
   
    Route::put('/adult_second_dose/edit_second_dose_immunization/{id}', [SecondDoseController::class, 'editAdultImmunization'])->name('editAdultImmunization');


    Route::get('/senior_second_dose', [SecondDoseController::class, 'seniorSecondDoseIndex'])->name('senior_second_dose');
    
    Route::put('/senior_second_dose/edit_second_dose_immunization/{id}', [SecondDoseController::class, 'editSeniorImmunization'])->name('editSeniorImmunization');
    /* Second Dose */

    /* Third Dose */
    Route::get('/infant_third_dose', [ThirdDoseController::class, 'infantThirdDoseIndex'])->name('infant_third_dose');
    
    Route::put('/infant_third_dose/edit_third_dose_immunization/{id}', [ThirdDoseController::class, 'editInfantImmunization'])->name('3rdeditInfantImmunization');

    Route::get('/school_aged_children_third_dose', [ThirdDoseController::class, 'SchoolAgedThirdDoseIndex'])->name('school_aged_third_dose');
   
    Route::put('/school_aged_third_dose/edit_third_dose_immunization/{id}', [ThirdDoseController::class, 'editSchoolAgedImmunization'])->name('3rdeditSchoolAgedImmunization');

    Route::get('/pregnant_third_dose', [ThirdDoseController::class, 'pregnantThirdDoseIndex'])->name('pregnant_third_dose');
   
    Route::put('/pregnant_third_dose/edit_third_dose_immunization/{id}', [ThirdDoseController::class, 'editPregnantImmunization'])->name('3rdeditPregnantImmunization');

    Route::get('/adult_third_dose', [ThirdDoseController::class, 'adultThirdDoseIndex'])->name('adult_third_dose');
   
    Route::put('/adult_third_dose/edit_third_dose_immunization/{id}', [ThirdDoseController::class, 'editAdultImmunization'])->name('3rdeditAdultImmunization');


    Route::get('/senior_third_dose', [ThirdDoseController::class, 'seniorThirdDoseIndex'])->name('senior_third_dose');
   
    Route::put('/senior_third_dose/edit_third_dose_immunization/{id}', [ThirdDoseController::class, 'editSeniorImmunization'])->name('3rdeditSeniorImmunization');
    /* third Dose */

    Route::group(['middleware' => 'roleAdminOrNurse'], function () {
        Route::post('/vaccines/multi-action',[VaccineController::class,'multiAction'])->name('vaccineMultiAction');
        Route::resource('vaccines', VaccineController::class)->except(['create', 'show', 'edit']);
        Route::resource('/restore_immunization', RestoreImmunizationController::class)->only(['destroy']);
        Route::post('archives/multiAction', [ArchiveController::class,'multiAction'])->name('archiveMultiaction');
        Route::resource('archives', ArchiveController::class)->only(['index', 'destroy']);

        Route::get('/export', [ExportController::class, 'export'])->name('export');

        Route::put('/infant_second_dose/set_schedule/{id}', [SecondDoseController::class, 'infantSetSchedule'])->name('infantsetSchedule');
        Route::put('/school_aged_second_dose/set_schedule/{id}', [SecondDoseController::class, 'SchoolAgedSetSchedule'])->name('schoolAgedSetSchedule');
        Route::put('/pregnant_second_dose/set_schedule/{id}', [SecondDoseController::class, 'pregnantSetSchedule'])->name('pregnantSetSchedule');
        Route::put('/adult_second_dose/set_schedule/{id}', [SecondDoseController::class, 'adultSetSchedule'])->name('adultSetSchedule');
        Route::put('/senior_second_dose/set_schedule/{id}', [SecondDoseController::class, 'seniorSetSchedule'])->name('seniorSetSchedule');

        Route::put('/infant_third_dose/set_schedule/{id}', [ThirdDoseController::class, 'infantSetSchedule'])->name('3rdinfantsetSchedule');
        Route::put('/school_aged_third_dose/set_schedule/{id}', [ThirdDoseController::class, 'SchoolAgedSetSchedule'])->name('3rdschoolAgedSetSchedule');
        Route::put('/pregnant_third_dose/set_schedule/{id}', [ThirdDoseController::class, 'pregnantSetSchedule'])->name('3rdpregnantSetSchedule');
        Route::put('/adult_third_dose/set_schedule/{id}', [ThirdDoseController::class, 'adultSetSchedule'])->name('3rdadultSetSchedule');
        Route::put('/senior_third_dose/set_schedule/{id}', [ThirdDoseController::class, 'seniorSetSchedule'])->name('3rdseniorSetSchedule');
        

        Route::get('/database_backup',[DatabaseBackupController::class,'index'])->name('database_backup.index');
        Route::post('/database_export',[DatabaseBackupController::class,'exportDatabase'])->name('exportDatabase');

        Route::get('/send_sms',[SendSMSController::class, 'send'])->name('sendSMS');
        Route::get('/reports', [ReportController::class,'index'])->name('report');

        Route::get('/user_activity_logs',[UserActivityLogController::class,'index'])->name('user_activity_log.index');
    });




    Route::resource('manage_users', ManageUserController::class)->name('index', 'manage_users')->middleware('roleAdmin');
    Route::post('manage_users/multiAction', [ManageUserController::class,'multiAction'])->name('manageUserMultiAction')->middleware('roleAdmin');
    
});

// Route::get('/login2', function(){
//     if(auth()->check()){
//         return redirect('/dashboard');
//     }
//     return view('auth.login2');
// });

// Route::view('/chart', 'chart');

Route::get('/try',function(){

    //SELECT * FROM `immunizations`WHERE (doses >= 2 AND doses_received=1) AND second_dose_schedule < DATE_ADD(CURDATE(), INTERVAL 1 DAY) AND second_dose_schedule != 'Not Applicable' AND third_dose_schedule != 'Not Applicable';
    $incompletes2ndDose = Immunization::where('doses','>=','2')->where('doses_received','1')->where('second_dose_schedule', '!=', 'Not Applicable')->where('third_dose_schedule', '!=', 'Not Applicable')->whereDate('second_dose_schedule' ,'<', now())->get();

    //SELECT * FROM `immunizations`WHERE (doses = 3 AND doses_received=2) AND third_dose_schedule < DATE_ADD(CURDATE(), INTERVAL 1 DAY) AND third_dose_schedule != 'Not Applicable';
    $incompletes3rdDose = Immunization::where('doses','3')->where('doses_received','2')->where('third_dose_schedule', '!=', 'Not Applicable')->whereDate('third_dose_schedule' ,'<', now())->get();

   



    dd($incompletes3rdDose);
    
});


