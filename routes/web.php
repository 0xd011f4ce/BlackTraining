<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\AdminCoursecontroller;
use App\Http\Controllers\AdminForumController;
use App\Http\Controllers\AdminImageBoardController;
use App\Http\Controllers\AdminLessonController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminSectionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ImageBoardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PageController;

Route::get("/", function () {
    return view("home");
})->name("home.index");

// Authentication routes
Route::get('/signup', [SignupController::class, "index"])->name("signup.index");
Route::post('/signup', [SignupController::class, "store"])->name("signup.store");
Route::get('/login', [LoginController::class, "index"])->name("login.index");
Route::post('/login', [LoginController::class, "store"])->name("login.store");
Route::get("/logout", [LogoutController::class, "index"])->name("logout.index");

// pages
Route::get("/p/{page:path}", [PageController::class, "show"])->name("pages.show");

// courses
Route::get("/courses", [CourseController::class, "index"])->name("courses.index");
Route::get("/course/{course:slug}", [CourseController::class, "show"])->name("courses.show");
Route::get("/course/{course:slug}/lesson/{lesson:slug}", [CourseController::class, "lesson"])->name("courses.lesson");

// imade boards
Route::get("/boards", [ImageBoardController::class, "index"])->name("boards.index");
Route::get("/boards/{board:identifier}", [ImageBoardController::class, "show"])->name("boards.show");
Route::post("/boards/{board:identifier}", [ImageBoardController::class, "store"])->middleware("auth")->name("boards.store");
Route::get("/boards/{board:identifier}/thread/{image_board_post:slug}", [ImageBoardController::class, "thread"])->name("boards.thread");
Route::post("/boards/{board:identifier}/thread/{image_board_post:slug}", [ImageBoardController::class, "reply"])->middleware("auth")->name("boards.reply");

// forum
Route::get("/forum", [ForumController::class, "index"])->name("forum.index");
Route::get("/forum/{forum_category:slug}", [ForumController::class, "show"])->name("forum.show");
Route::get("/forum/{forum_category:slug}/create", [ForumController::class, "post"])->name("forum.post")->middleware("auth");
Route::post("/forum/{forum_category:slug}/create", [ForumController::class, "store"])->name("forum.store")->middleware("auth");
Route::get("/forum/{forum_category:slug}/{forum_post:slug}", [ForumController::class, "thread"])->name("forum.thread");
Route::post("/forum/{forum_category:slug}/{forum_post:slug}", [ForumController::class, "reply"])->name("forum.reply");
Route::get("/forum/{forum_category:slug}/{forum_post:slug}/edit", [ForumController::class, "edit"])->name("forum.edit")->middleware("auth");
Route::post("/forum/{forum_category:slug}/{forum_post:slug}/edit", [ForumController::class, "editStore"])->name("forum.edit.store")->middleware("auth");

// Admin routes
Route::middleware(["auth", "roles:admin"])->group(function () {
    Route::get("/admin", [AdminController::class, "index"])->name("admin.index");

    // courses
    Route::get("/admin/courses/new", [AdminCoursecontroller::class, "index"])->name("admin.courses.new.index");
    Route::post("/admin/courses/new", [AdminCoursecontroller::class, "store"])->name("admin.courses.new.store");
    Route::get("/admin/courses/manage", [AdminCoursecontroller::class, "show"])->name("admin.courses.show");

    Route::get("/admin/course/{course:slug}", [AdminCoursecontroller::class, "edit"])->name("admin.course.edit");
    Route::patch("/admin/course/{course:slug}", [AdminCoursecontroller::class, "update"])->name("admin.course.update");
    Route::delete("/admin/course/{course:slug}", [AdminCoursecontroller::class, "delete"])->name("admin.course.delete");

    Route::post("/admin/course/{course:slug}/sections/add", [AdminSectionController::class, "store"])->name("admin.course.sections.store");
    Route::get("/admin/course/{course:slug}/section/{course_section:slug}", [AdminSectionController::class, "edit"])->name("admin.course.sections.edit");
    Route::patch("/admin/course/{course:slug}/section/{course_section:slug}", [AdminSectionController::class, "update"])->name("admin.course.sections.update");
    Route::delete("/admin/course/{course:slug}/section/{course_section:slug}", [AdminSectionController::class, "destroy"])->name("admin.course.sections.destroy");

    Route::post("/admin/course/{course:slug}/section/{course_section:slug}/lesson/add", [AdminLessonController::class, "store"])->name("admin.course.lessons.store");
    Route::get("/admin/course/{course:slug}/section/{course_section:slug}/lesson/{course_lesson:slug}", [AdminLessonController::class, "edit"])->name("admin.course.lessons.edit");
    Route::patch("/admin/course/{course:slug}/section/{course_section:slug}/lesson/{course_lesson:slug}", [AdminLessonController::class, "update"])->name("admin.course.lessons.update");
    Route::delete("/admin/course/{course:slug}/section/{course_section:slug}/lesson/{course_lesson:slug}", [AdminLessonController::class, "delete"])->name("admin.course.lessons.delete");

    // pages
    Route::post("/admin/pages/new", [AdminPageController::class, "store"])->name("admin.pages.new.store");
    Route::get("/admin/pages/new", [AdminPageController::class, "index"])->name("admin.pages.new.index");
    Route::get("/admin/pages/manage", [AdminPageController::class, "show"])->name("admin.pages.show");

    Route::get("/admin/page/{page:slug}", [AdminPageController::class, "edit"])->name("admin.page.edit");
    Route::patch("/admin/page/{page:slug}", [AdminPageController::class, "update"])->name("admin.page.update");
    Route::delete("/admin/page/{page:slug}", [AdminPageController::class, "delete"])->name("admin.page.delete");

    // image board
    Route::post("/admin/boards/new", [AdminImageBoardController::class, "store"])->name("admin.boards.new.store");
    Route::get("/admin/boards/new", [AdminImageBoardController::class, "index"])->name("admin.boards.new.index");
    Route::get("/admin/boards/manage", [AdminImageBoardController::class, "show"])->name("admin.boards.show");

    Route::get("/admin/board/{board:identifier}", [AdminImageBoardController::class, "edit"])->name("admin.board.edit");
    Route::patch("/admin/board/{board:identifier}", [AdminImageBoardController::class, "update"])->name("admin.board.update");
    Route::delete("/admin/board/{board:identifier}", [AdminImageBoardController::class, "delete"])->name("admin.board.delete");

    // forum
    Route::get("/admin/forum/new", [AdminForumController::class, "index"])->name("admin.forums.new.index");
    Route::post("/admin/forum/new", [AdminForumController::class, "store"])->name("admin.forums.new.store");
});
