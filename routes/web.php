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







Route::get('language-chang/{lang}',function($lang){

    Session::put('locale', $lang);

    return redirect()->back();
    })->name('change.lang');

    Route::get('/',function(){
        return redirect('login');
    });

Route::group(['middleware' => 'localization'], function() {
    Auth::routes();

    Route::group(['prefix' => 'admin','as'=>'admin.','middleware' =>['role:SuperAdmin|Admin']], function() {

    Route::get('get/course', [App\Http\Controllers\Admin\CourseController::class, 'getCourse'])->name('getCourse');

    Route::get('get/category', [App\Http\Controllers\Admin\CategoryController::class, 'getCategory'])->name('getCategory');

    Route::get('get/exam', [App\Http\Controllers\Admin\ExamController::class, 'getExam'])->name('getExam');

    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'profle'])->name('profile');
    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('course', App\Http\Controllers\Admin\CourseController::class);
    Route::get('/course/destroy/{id}', [App\Http\Controllers\Admin\CourseController::class, 'delete'])->name('course.delete');
    Route::resource('quiz', App\Http\Controllers\Admin\QuizController::class);
    Route::get('quiz/create/{id}', [App\Http\Controllers\Admin\QuizController::class, 'create'])->name('quiz.create');
    Route::resource('activity', App\Http\Controllers\Admin\ActivityController::class);
    Route::post('question-answar', [App\Http\Controllers\Admin\QuizController::class, 'question'])->name('quiz.answar');
    Route::post('course/test', [App\Http\Controllers\Admin\QuizController::class, 'course_test'])->name('course.test');
    Route::get('course/question/{id}', [App\Http\Controllers\Admin\QuizController::class, 'get_course_test']);
    Route::get('course/question/{id}', [App\Http\Controllers\Admin\QuizController::class, 'edit_course_test'])->name('course.question.edit');
    Route::put('course/question/{id}', [App\Http\Controllers\Admin\QuizController::class, 'update_course_test'])->name('course.question.update');
    Route::get('/course/{status}/{id}', [App\Http\Controllers\Admin\CourseController::class, 'status'])->name('course.status');

    Route::get('/question/{id}', [App\Http\Controllers\Admin\QuizController::class, 'delete_course_test'])->name('course.question.delete');
    Route::get('/section/destroy/{id}', [App\Http\Controllers\Admin\SectionController::class, 'delete'])->name('section.delete');
    Route::resource('section', App\Http\Controllers\Admin\SectionController::class);
    Route::get('/section/create/{id}', [App\Http\Controllers\Admin\SectionController::class, 'create'])->name('section.create');

    //Configurations
    Route::get('/setting', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/{sso_config}/{crm_configuration}', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('setting.update');
    Route::resource('dashboard', App\Http\Controllers\Admin\DashboardController::class);


    //Lesson Route
    Route::resource('lesson', App\Http\Controllers\Admin\LessonController::class);
    Route::get('/lesson/destroy/{id}', [App\Http\Controllers\Admin\LessonController::class, 'delete'])->name('lesson.delete');
    Route::get('/lesson/create/{id}', [App\Http\Controllers\Admin\LessonController::class, 'create'])->name('lesson.create');


    //Trainer Route
    Route::resource('trainer', App\Http\Controllers\Admin\TrainerController::class)->parameters(['trainer' => 'user']);
    Route::get('/trainer/show/{user}', [App\Http\Controllers\Admin\TrainerController::class, 'show'])->name('trainer.show');
    Route::get('/category/destroy/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/trainer/destroy/{user}', [App\Http\Controllers\Admin\TrainerController::class, 'delete'])->name('trainer.delete');

    //Exam Route
    Route::get('/exam', [App\Http\Controllers\Admin\ExamController::class, 'index'])->name('exam.index');
    Route::get('/exam/create', [App\Http\Controllers\Admin\ExamController::class, 'create'])->name('exam.create');
    Route::post('/exam', [App\Http\Controllers\Admin\ExamController::class, 'store'])->name('exam.store');
    Route::get('/exam/{id}', [App\Http\Controllers\Admin\ExamController::class, 'edit'])->name('exam.edit');
    Route::get('/exam/delete/{id}', [App\Http\Controllers\Admin\ExamController::class, 'delete'])->name('exam.delete');
    Route::put('/exam/{id}', [App\Http\Controllers\Admin\ExamController::class, 'update'])->name('exam.update');

    //Admin Profile Route
    Route::put('/profile/{id}', [App\Http\Controllers\Admin\AdminController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/password-change', [App\Http\Controllers\Admin\AdminController::class, 'changePassword'])->name('password.change');

    //Sub Admin Route
    Route::get('/sub-admin', [App\Http\Controllers\Admin\SubAdminController::class, 'index'])->name('subadmin.index');
    Route::get('/sub-admin/create', [App\Http\Controllers\Admin\SubAdminController::class, 'create'])->name('subadmin.create');
    Route::post('/sub-admin', [App\Http\Controllers\Admin\SubAdminController::class, 'store'])->name('subadmin.store');
    Route::get('/sub-admin/destroy/{user}', [App\Http\Controllers\Admin\SubAdminController::class, 'destroy'])->name('subadmin.destroy');
    Route::get('/sub-admin/edit/{user}', [App\Http\Controllers\Admin\SubAdminController::class, 'edit'])->name('subadmin.edit');
    Route::get('/sub-admin/show/{user}', [App\Http\Controllers\Admin\SubAdminController::class, 'show'])->name('subadmin.show');
    Route::put('/sub-admin/update/{user}', [App\Http\Controllers\Admin\SubAdminController::class, 'update'])->name('subadmin.update');

    //Certificate Route
    Route::get('/certificate', [App\Http\Controllers\Admin\CertificateController::class, 'index'])->name('certificate.index');
    Route::get('/certificate/show/{certificate}', [App\Http\Controllers\Admin\CertificateController::class, 'show'])->name('certificate.show');


    //Student Route
    Route::get('/student', [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('student.index');
    Route::get('/student/show/{id}', [App\Http\Controllers\Admin\StudentController::class, 'show'])->name('student.show');

});


    Route::group(['prefix' => 'trainer','as'=>'trainer.','middleware' => ['role:Trainer']], function() {
        Route::get('/', [App\Http\Controllers\Trainer\TrainerController::class, 'index'])->name('index');
        Route::get('/profile', [App\Http\Controllers\Trainer\TrainerController::class, 'profile'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\Trainer\TrainerController::class, 'profileUpdate'])->name('profile.update');
        Route::post('/password-change', [App\Http\Controllers\Trainer\TrainerController::class, 'changePassword'])->name('password.change');
        Route::resource('course', App\Http\Controllers\Trainer\CourseController::class);
        Route::post('course/test', [App\Http\Controllers\Trainer\QuizController::class, 'course_test'])->name('course.test');
        Route::get('course/question/{id}', [App\Http\Controllers\Trainer\QuizController::class, 'get_course_test']);
        Route::put('course/question/{id}', [App\Http\Controllers\Trainer\QuizController::class, 'update_course_test']);
        Route::delete('/question/{id}', [App\Http\Controllers\Trainer\QuizController::class, 'delete_course_test']);
        Route::get('/section/destroy/{id}', [App\Http\Controllers\Trainer\SectionController::class, 'delete'])->name('section.delete');
        Route::get('/lesson/destroy/{id}', [App\Http\Controllers\Trainer\LessonController::class, 'delete'])->name('lesson.delete');
        Route::get('/course/{status}/{id}', [App\Http\Controllers\Trainer\CourseController::class, 'status'])->name('course.status');
        Route::resource('section', App\Http\Controllers\Trainer\SectionController::class);
        Route::resource('lesson', App\Http\Controllers\Trainer\LessonController::class);


    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});
