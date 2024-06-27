<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\DataP3KController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RequestP3KController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\KotakP3KController;
use App\Http\Controllers\ViewKotakController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\exportController;
use App\Http\Controllers\export2Controller;
use App\Http\Controllers\LemariController;

// use App\Models\kotak;
// use App\Models\Data_P3K;

// use App\Http\Controllers\RegisterController;


// Route::get('/export1', function () {
//     return view('pages.PDF');
// });





Route::group(['middleware' => ['auth', 'role.user']], function () {
	Route::get('/input_P3K', [InputController::class, 'index'])->name('input_P3K.index');
	Route::post('/input_P3K', [InputController::class, 'store'])->name('input_P3K.store');
	Route::get('/kotak/{id}/items', [InputController::class, 'getItemsByKotakId'])->name('kotak.items');

	// route untuk menu request
	Route::get('/request_P3K', [RequestP3KController::class, 'index'])->name('request_P3K.index');
	Route::post('/request_P3K', [RequestP3KController::class, 'store'])->name('request_P3K.store');
	// Route::get('/kotak', [ViewKotakController::class, 'index'])->name('kotak.index');
	// Route::get('/kotak/{id}', [ViewKotakController::class, 'show'])->name('isi_kotak.detail');



	// route untuk export history penggunaan	


	Route::get('/landing', function () {
		return view('pages.Landing_User');
	})->name('landing.index');


});



Route::group(['middleware' => ['auth', 'role:admin,teamP3K']], function () {
	Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
	Route::get('/history/request', [HistoryController::class, 'show'])->name('history.request');
	Route::get('/export_inspeksi', [export2Controller::class, 'exportForm'])->name('inspeksi.show');
	Route::get('/export_inspeksi/{id}', [export2Controller::class, 'exportPdf2'])->name('exportPDF2');
	Route::get('/kotak', [ViewKotakController::class, 'index'])->name('kotak.index');
	Route::get('/kotak/{id}', [ViewKotakController::class, 'show'])->name('isi_kotak.detail');
	Route::get('/add_isi/{id}', [ViewKotakController::class, 'add'])->name('isi_kotak.add');
	Route::post('/add_isi/{id}', [ViewKotakController::class, 'store'])->name('isi_kotak.store');
	Route::delete('/delete_isi/{kotakId}/{dataP3kId}', [ViewKotakController::class, 'destroy'])->name('isi_kotak.destroy');

});

Route::group(['middleware' => ['auth', 'role.admin']], function () {
	// route untuk menu User Management
	Route::get('/view_user', [UsersController::class, 'index'])->name('view_user.index');
	Route::get('/view_user/{id}', [UsersController::class, 'show'])->name('view_user.detail');
	Route::post('/update_user/{id}', [UsersController::class, 'update'])->name('view_user.update');
	Route::get('/delete_user/{id}', [UsersController::class, 'delete'])->name('view_user.delete');
	Route::get('/add_user', [UsersController::class, 'add'])->name('add_user.add');
	Route::post('/add_user', [UsersController::class, 'store'])->name('add_user.store');
	
	


	// route untuk menu kotak Management
	Route::get('/kotak_p3k', [KotakP3KController::class, 'index'])->name('kotak_p3k.index');
	Route::get('/delete_kotak/{id}', [KotakP3KController::class, 'delete'])->name('kotak_p3k.delete');
	Route::get('/kotak_p3k_add', [KotakP3KController::class, 'add'])->name('kotak_p3k.add');
	Route::post('/kotak_p3k', [KotakP3KController::class, 'store'])->name('kotak_p3k.store');

	// route untuk menu data P3k
	Route::get('/data_p3k', [DataP3KController::class, 'index'])->name('data_p3k.index');
	Route::post('/data_p3k', [DataP3KController::class, 'store'])->name('data_p3k.store');
	Route::post('/update_data/{id}', [DataP3KController::class, 'update'])->name('data_p3k.update');
	Route::get('/data_p3k/{id}', [DataP3KController::class, 'show'])->name('data_p3k.detail');
	Route::get('/delete_data/{id}', [DataP3KController::class, 'delete'])->name('data_p3k.delete');

	// route untuk submenu Kotak P3k
	// Route::get('/kotak', [ViewKotakController::class, 'index'])->name('kotak.index');
	// Route::get('/kotak/{id}', [ViewKotakController::class, 'show'])->name('isi_kotak.detail');
	Route::get('/add_isi/{id}', [ViewKotakController::class, 'add'])->name('isi_kotak.add');
	Route::post('/add_isi/{id}', [ViewKotakController::class, 'store'])->name('isi_kotak.store');
	Route::delete('/delete_isi/{kotakId}/{dataP3kId}', [ViewKotakController::class, 'destroy'])->name('isi_kotak.destroy');

	// route untuk submenu Kotak P3k
	Route::get('/lemari', [LemariController::class, 'index'])->name('lemari.index');
	Route::get('/lemari/show', [LemariController::class, 'show'])->name('lemari.show');
	Route::post('/lemari/store', [LemariController::class, 'store'])->name('lemari.store');
	Route::get('/lemari/{id}', [LemariController::class, 'destroy'])->name('lemari.destroy');

	// route untuk export
	Route::get('/export', [exportController::class, 'exportPdf'])->name('exportPDF');
	Route::get('/export/show', [exportController::class, 'show'])->name('export.show');

	Route::post('/export_inspeksi/{id}', [export2Controller::class, 'exportPdf2'])->name('exportPDF2');
	Route::get('/export_inspeksi/{id}', [export2Controller::class, 'show'])->name('export2.show');




});

Route::group(['middleware' => ['auth', 'role.manager']], function () {

});

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');


Route::group(['middleware' => 'auth'], function () {

	// route untuk menu profile
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

	Route::get('/export_inspeksi', [export2Controller::class, 'exportForm'])->name('inspeksi.show');
	Route::get('/export_inspeksi/{id}', [export2Controller::class, 'exportPdf2'])->name('exportPDF2');
	// route untuk menangani request page	
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');



});

