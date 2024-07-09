<?php

use App\Http\Controllers\AdminController;
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

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/adminlogin', function () {
    return view('admin.login');
});
Route::post('/admin', [AdminController::class, 'index']);

Route::post('/adminlogin', function () {
    return view('admin.login');
});

Route::get('/admin/school', function () {
    return view('admin.school', [
        'schools'=>\App\Models\School::all(),
    ]);
});

Route::get('/admin/addschool', function () {
    return view('admin.addschool');
});

Route::post('/admin/addschool', [\App\Http\Controllers\SchoolController::class, 'store'])->name('school.store');

Route::get('/admin/teachers', function () {
    return view('admin.teacher',
        [
            'teachers'=>\App\Models\Teacher::all(),
        ]);
});
Route::get('/admin/students', function () {
    return view('admin.student',
        [
            'students'=>\App\Models\Student::all(),
        ]);
});
Route::get('/admin/parents', function () {
    return view('admin.parent',
        [
            'parents'=>\App\Models\Parents::all(),
        ]);


});

Route::get('teacher', function (){
   return view('teachers.dashboard');
});
Route::get('/teacher/teachers', function () {
    return view('teachers.teachers',
        [
            'teachers'=>\App\Models\Teacher::all(),
            'subjects'=>\App\Models\Subject::all(),
        ]);


});
Route::get('/teacher/addteacher', function () {
    return view('teachers.addteacher');
});

Route::get('/teacher/class', function () {
    return view('teachers.class',[
        'classes'=>\App\Models\Darasa::all(),
    ]);
});
Route::get('/teacher/subjects', function () {
    return view('teachers.subjects',[
        'subjects'=>\App\Models\Subject::all(),
    ]);
});

Route::get('/login', function () {
    return view('login');
});
