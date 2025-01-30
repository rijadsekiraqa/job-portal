<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Models\Application;

Route::get('/', [HomeController::class, 'index'])->name('landing.page');
Route::get('/jobdetail/{id}', [HomeController::class, 'jobdetail'])->name('job-detail');
Route::get('/home-page/filter', [HomeController::class, 'filterJobs'])->name('landingpage.filterJobs');
Route::post('applications/{id}/apply', [HomeController::class, 'applyjob'])->name('applications.apply');




Route::middleware('guest')->group(function () {
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/signup', [LoginController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [LoginController::class, 'signup']);
Route::get('/review', [LoginController::class, 'showReviewPage'])->name('review');
});

Route::prefix('admin-dashboard')->group(function () {
Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
Route::get('/notifications', [AdminDashboardController::class, 'notifications'])->name('notifications.index');
Route::post('/notifications/read', [AdminDashboardController::class, 'markNotificationsAsRead'])
    ->name('notifications.read');
Route::get('/expired', [AdminDashboardController::class, 'expiredAnnouncements'])->name('announcements.expired');
Route::resource('categories',CategoryController::class);
Route::get('/categories/delete/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::post('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulkDelete');
Route::resource('cities', CityController::class);
Route::get('/cities/delete/{city}', [CityController::class, 'destroy'])->name('cities.destroy');
Route::post('/cities/bulk-delete', [CityController::class, 'bulkDelete'])->name('cities.bulkDelete');
Route::resource('companies',CompanyController::class);
Route::get('/companies/delete/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
Route::post('/companies/bulk-delete', [CompanyController::class, 'bulkDelete'])->name('companies.bulkDelete');
Route::resource('announcements',AnnouncementController::class);
Route::put('/announcements/{id}/update-description', [AnnouncementController::class, 'updateDescription'])->name('announcements.updateDescription');
Route::get('/announcements/delete/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
Route::post('/announcements/bulk-delete', [AnnouncementController::class, 'bulkDelete'])->name('announcements.bulkDelete');
Route::get('manage-announcements', [AnnouncementController::class, 'manageAnnouncements'])->name('announcements.manage');
Route::get('/manage-announcements/view/{id}', [AnnouncementController::class, 'viewmanageAnnouncements'])
    ->name('announcements.view');
Route::get('manage-announcements/{id}/edit', [AnnouncementController::class, 'editmanageAnnouncements'])->name('manage-announcements.edit');
Route::put('/manage-announcements/{id}/update', [AnnouncementController::class, 'updatemanageAnnouncements'])->name('manage-announcements.update');
Route::put('/manage-announcements/{id}/update-description', [AnnouncementController::class, 'updateDescription'])->name('manage-announcements.updateDescription');
Route::get('/manage-announcements/{announcement}/update-status', [AnnouncementController::class, 'updateStatus'])->name('updatestatus');

Route::resource('permission',PermissionController::class);
Route::get('/permissions/delete/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
Route::resource('role',RoleController::class);
Route::get('/roles/delete/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::resource('users',UserController::class);
Route::get('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('userprofile', [UserController::class,'userprofile'])->name('userprofile');
Route::put('userprofile/{id}', [UserController::class, 'updateuserprofile'])->name('updateuserprofile');
Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('applications.show');

// Route::fallback(function () {
//     return response()->view('admin.errors.error-404');
// });

});


// });



