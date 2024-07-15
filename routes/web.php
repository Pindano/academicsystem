<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Models\Darasa;
use App\Models\Examination;
use App\Models\Parents;
use App\Models\Subject;
use App\Models\Teacher;
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






Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [\App\Http\Controllers\SessionController::class,'index']);

Route::middleware('auth:teacher')->group(function () {

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
    Route::get('teacher', function () {
        $userId = Auth::id();
        $teacher = Teacher::where('id', $userId)->first();
        return view('teachers.dashboard', ['teacher' => $teacher]);
    });
    Route::get('/teacher/addparent', function () {
        return view('teachers.addparent');
    });
    Route::post('/teacher/addparent', [\App\Http\Controllers\ParentController::class, 'register']);
    Route::get('/teacher/addteacher', function () {
        return view('teachers.addteacher');
    });
    Route::get('/teacher/my-class', function () {

        $teacher = Teacher::find(auth()->user()->id);


        $darasa = $teacher->classes()->first();


        $parents = Parents::whereHas('students', function ($query) use ($darasa) {
            $query->where('darasas_id', $darasa->id);
        })->get();

        return view('teachers.myclass', [
            'darasa' => $darasa,
            'parents' => $parents,
        ]);
    });
    Route::get('/examinations', function (){
        $school_id = auth()->user()->school_id;
        $exams = \App\Models\Examination::where('school_id', $school_id)->get();
        return view('teachers.examinations', [
            'exams'=>$exams,

        ]);
    });
    Route::get('/examinations/{examination}', function (Examination $examination) {
        $teacher = auth()->user();
        $school_id = $teacher->school_id;

        // Eager load subjects and classes with teachers' constraints
        $subjects = \App\Models\Subject::whereHas('teachers', function ($query) use ($teacher) {
            $query->where('teachers.id', $teacher->id);
        })->with(['darasas' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        }])->get();

        return view('teachers.grade', [
            'school_id' => $school_id,
            'teacher' => $teacher,
            'subjects' => $subjects,
            'examination' => $examination,
        ]);
    })->name('examinations.show');
    Route::get('/teacher/{teacher}/grade/{class}/{subject}', function ($teacherId, $classId, $subjectId) {
        $teacher = Teacher::find($teacherId);
        $class = Darasa::find($classId);
        $subject = Subject::find($subjectId);
        $students = $class->students;

        return response()->json([
            'teacher' => $teacher,
            'class' => $class,
            'subject' => $subject,
            'students' => $students,
        ]);
    });
    Route::post('/teacher/{teacher}/grade/{class}/{subject}', [\App\Http\Controllers\GradeController::class, 'store']
    );

    Route::middleware('admin')->group(function () {
        Route::get('/teacher/teachers', function () {
            $school_id = auth()->user()->school_id;
            $teachers = \App\Models\Teacher::where('school_id', $school_id)->get();
            $darasas = \App\Models\Darasa::where('school_id', $school_id)->get();
            $subjects = Subject::where('school_id', $school_id)->get();
            return view('teachers.teachers', [
                'darasas' => $darasas,
                'teachers'=>$teachers,
                'subjects' => $subjects,
            ]);
        });

        Route::get('/teacher/{teacher}', function (Teacher $teacher){
            return view('teachers.manage', [
                $school_id = auth()->user()->school_id,
                'teacher' => $teacher,
                'classes' => \App\Models\Darasa::where('school_id', $school_id)->get(),
                'subjects' => \App\Models\Subject::where('school_id', $school_id)->get(),
            ]);
        });

        Route::post('/teacher/assign-class', [TeacherController::class, 'assignClass']);
        Route::post('/teacher/unassign-class', [TeacherController::class, 'unassignClass']);
        Route::post('/teacher/assign-subjects', [TeacherController::class, 'assignSubjects']);
        Route::post('/teacher/unassign-subject', [TeacherController::class, 'unassignSubject']);



        Route::post('/teacher/addteacher', [\App\Http\Controllers\TeacherController::class, 'store']);
        Route::post('/teacher/addsubject', [\App\Http\Controllers\TeacherController::class, 'subject']);
        Route::post('/teacher/addclass', [\App\Http\Controllers\TeacherController::class, 'darasa']);
        Route::get('/exam', function (){
            $school_id = auth()->user()->school_id;
            $exams = \App\Models\Examination::where('school_id', $school_id)->get();
            return view('teachers.exams', [
                'exams'=>$exams,
                'school_id'=>$school_id,
            ]);
        });




        Route::post('/exams', [\App\Http\Controllers\ExaminationsController::class, 'store']);


    });
});

Route::middleware('auth:parent')->group(function () {

    Route::get('/parent', function () {
        $parent_id = auth()->user()->id;
        $parent = Parents::find($parent_id);
        $students = $parent->students;
        return view('Parent.dashboard',[
            'students'=>$students,
        ]);
    });

});


