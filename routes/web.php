<?php

use App\Http\Controllers\{ CheckRoleController, GiveRoleController };
use App\Http\Livewire\Student\{ Dashboard as StudentDashboard, ShowLesson as StudentShowLesson };
use App\Http\Livewire\Teacher\{ Dashboard as TeacherDashboard };
use App\Http\Livewire\Admin\{ Dashboard as AdminDashboard};

use App\Http\Livewire\Admin\Lesson\{ 
    Index   as AdminLessonIndex, 
    Add     as AdminLessonAdd,
    Show    as AdminLessonShow
};

use App\Http\Livewire\Admin\User\Student\{ 
    Index   as AdminStudentIndex, 
    Add     as AdminStudentAdd
};

use App\Http\Livewire\Admin\User\Teacher\{ 
    Index   as AdminTeacherIndex, 
    Show    as AdminTeacherShow, 
    Add     as AdminTeacherAdd
};
use App\Http\Livewire\Teacher\Question\{ Add as TeacherQuestionAdd};
use App\Http\Livewire\Teacher\Score\{ Index as TeacherScoreIndex };
use App\Models\Lesson;
use App\Models\Question;
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
    return view('hello', [
        'lessons'   => Lesson::whereUserId(auth()->user()->id)->get(),
        'questions' => Question::latest()->get()
    ]);
});
Route::get('/checkrole', CheckRoleController::class);
Route::get('/giverole', GiveRoleController::class);




// student route group
Route::middleware(['role:student', 'auth'])->prefix('student')->group(function () {
    Route::get('/dashboard', StudentDashboard::class)->name('student.dashboard');
    Route::get('/lessons/{slug}/{page}', StudentShowLesson::class)->name('student.lesson.show');
});

// teacher route group
Route::middleware(['role:teacher', 'auth'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', TeacherDashboard::class)->name('teacher.dashboard');

    Route::get('/scores', TeacherScoreIndex::class)->name('teacher.score.index');
    
    Route::get('/questions/add', TeacherQuestionAdd::class)->name('teacher.question.add');
});

// Admin Route Group
Route::middleware(['role:admin', 'auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    
    // Admin Lesson = Mengelola data Pelajaran
    Route::prefix('lessons')->name('lessons.')->group(function(){
        Route::get('/', AdminLessonIndex::class)->name('index');
        Route::get('/add', AdminLessonAdd::class)->name('add');
        Route::get('/{slug}/show', AdminLessonShow::class)->name('show');
    });

    // Admin Teacher = Mengelola data Guru
    Route::prefix('teachers')->name('teachers.')->group(function(){
        Route::get('/', AdminTeacherIndex::class)->name('index');
        Route::get('/{slug}/show', AdminTeacherShow::class)->name('show');
        Route::get('/add', AdminTeacherAdd::class)->name('add');
    });
    
    // Admin Student = Mengelola data Siswa
    Route::prefix('students')->name('students.')->group(function(){
        Route::get('/', AdminStudentIndex::class)->name('index');
        Route::get('/add', AdminStudentAdd::class)->name('add');
    });
    
});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
