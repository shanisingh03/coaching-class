<?php

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
// Welcome Page
Route::get('/', 'TemplateController@getWelcomePage')->name('welcome');

// Disable Register route
Auth::routes(['register' => false]);

// Authenticated Routes
Auth::routes(['verify' => true]);


// Default Home Controller
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Superadmin Routes
Route::prefix('superadmin')->name('superadmin.')->namespace('SuperAdmin')->middleware(['auth', 'superadmin','verified'])->group(function () {
    // Dashboard 
    Route::get('/','DashboardController@index')->name('dashboard');

    //Institute Routes
    Route::prefix('institute')->name('institute.')->group(function() {
        Route::get('/','InstituteController@index')->name('list');
        Route::get('/details/{institute_id}','InstituteController@getDetails')->name('details');
        Route::get('/create','InstituteController@create')->name('create');
        Route::post('/store','InstituteController@store')->name('store');
        Route::get('/edit/{institute_id}','InstituteController@edit')->name('edit');
        Route::post('/update','InstituteController@update')->name('update');
        Route::post('/delete','InstituteController@delete')->name('delete');
    });

    //Institute Admins
    Route::prefix('institute/admin')->name('institute.admin.')->namespace('Institute')->group(function() {
        Route::post('/store','InstituteAdminController@storeAdmin')->name('create');
        Route::post('/update','InstituteAdminController@updateAdmin')->name('update');
    });

    // Profile
    Route::prefix('profile')->name('profile.')->namespace('Profile')->group(function() {
        Route::get('','ProfileController@getProfileDetail')->name('details');
        Route::post('update','ProfileController@updateProfile')->name('update');
        Route::post('change-password','ProfileController@resetPassword')->name('change-password');
    });

});


// Admin Routes
Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware(['auth', 'admin','verified'])->group(function () {
    // Dashboard 
    Route::get('/','DashboardController@index')->name('dashboard');

    // Profile
    Route::prefix('profile')->name('profile.')->namespace('Profile')->group(function() {
        Route::get('','ProfileController@getProfileDetail')->name('details');
        Route::post('update','ProfileController@updateProfile')->name('update');
        Route::post('change-password','ProfileController@resetPassword')->name('change-password');
    });

    //Settings
    Route::prefix('setting')->name('setting.')->group(function() {
        Route::get('/','SettingController@getSettings')->name('details');
        Route::post('/update/institute','SettingController@updateInstituteSetting')->name('update-institute-setting');
    });
    
    //Courses 
    Route::prefix('course')->name('course.')->namespace('Course')->group(function() {
        Route::get('/','CourseController@getCourseList')->name('list');
        Route::get('/{course_id}/details','CourseController@getCourseDetails')->name('details');
        Route::get('/create','CourseController@createCourse')->name('create');
        Route::post('/store','CourseController@storeCourse')->name('store');
        Route::get('/edit/{course_id}','CourseController@editCourse')->name('edit');
        Route::post('/update/{course_id}','CourseController@updateCourse')->name('update');
    });

    // Subjects
    Route::prefix('subject')->name('subject.')->namespace('Subject')->group(function() {
        Route::get('/','SubjectController@getSubjectList')->name('list');
        Route::get('/{subject_id}/details','SubjectController@getSubjectDetails')->name('details');
        Route::get('/create','SubjectController@createSubject')->name('create');
        Route::post('/store','SubjectController@storeSubject')->name('store');
        Route::get('/edit/{subject_id}','SubjectController@editSubject')->name('edit');
        Route::post('/update/{subject_id}','SubjectController@updateSubject')->name('update');
        Route::get('/list-by-course/{course_id}','SubjectController@getSubjectByCourse')->name('list.by-course');
    });

    // Chapter List
    Route::prefix('chapter')->name('chapter.')->namespace('Chapter')->group(function() {
        Route::get('/','ChapterController@getChapterList')->name('list');
        Route::get('/{chapter_id}/details','ChapterController@getChapterDetails')->name('details');
        Route::get('/create','ChapterController@createChapter')->name('create');
        Route::post('/store','ChapterController@storeChapter')->name('store');
        Route::get('/edit/{chapter_id}','ChapterController@editChapter')->name('edit');
        Route::post('/update/{chapter_id}','ChapterController@updateChapter')->name('update');
    });
});