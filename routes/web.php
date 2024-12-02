<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\User\CartController;

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataOwnerController;
use App\Http\Controllers\Admin\DataMemberController;

use App\Http\Controllers\User\UserProdukController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserPemesananController;

use App\Http\Controllers\Admin\JasaLayananController;
use App\Http\Controllers\Admin\PemesananMasukController;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Owner\ProfileController as OwnerProfileController;
use App\Http\Controllers\User\UserKontakController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

// Email verification routes
Route::prefix('verify-email')->controller(VerificationController::class)->group(function () {
    Route::get('{id}/{token}', 'verify')->name('verify.email');
    Route::get('/resend', 'resendverify')->name('resend.verify.form');
    Route::post('/resend', 'resendVerification')->name('resend.verify');
});

// Forgot password routes
Route::controller(ForgotPasswordController::class)->middleware('guest')->group(function () {
    Route::get('forgot-password', 'index')->name('forgot.password');
    Route::post('forgot-password', 'sendResetLink')->name('forgot.password.post');
    Route::get('reset-password/{token}', 'resetPasswordForm')->name('reset.password.form');
    Route::post('reset-password/{token}', 'resetPassword')->name('reset.password');
});

// Owner routes
Route::middleware(['auth', 'verified', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('dashboard', [HomeController::class, 'ownerHome'])->name('owner.dashboard');
    Route::get('profile', [OwnerProfileController::class, 'index'])->name('owner.profile');
});

// Admin routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('profile', [ProfileController::class, 'update'])->name('admin.update');

    //produk
    Route::get('produk', [ProdukController::class, 'index'])->name('admin.produk');
    Route::get('create', [ProdukController::class, 'create'])->name('admin.create');
    Route::post('produkstore', [ProdukController::class, 'store'])->name('admin.produkstore');
    Route::get('edit/{produk}', [ProdukController::class, 'edit'])->name('admin.edit');
    Route::put('update/{produk}', [ProdukController::class, 'update'])->name('admin.produkupdate');
    Route::delete('delete/{produk}', [ProdukController::class, 'destroy'])->name('admin.produk.delete');

    //kategori
    Route::get('category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Orders
    Route::get('pemesanan', [PemesananMasukController::class, 'index'])->name('admin.pemesanan');
    Route::get('inputorder', [OrderController::class, 'index'])->name('admin.input.order');
    Route::get('produk/data', [OrderController::class, 'getProdukData']);

    // Jasa Layanan
    Route::resource('jasalayanan', JasaLayananController::class);

    // Users
    Route::get('listowner', [DataOwnerController::class, 'index'])->name('admin.listowner');
    Route::get('listadmin', [DataAdminController::class, 'index'])->name('admin.listadmin');
    Route::get('listmember', [DataMemberController::class, 'index'])->name('admin.listuser');
    Route::post('store', [DataAdminController::class, 'storeAdmin'])->name('admin.store');
});

//Route untuk halaman user
Route::get('/', [HomeController::class, 'userHome'])->name('user.home');
Route::get('/profile', [UserProfileController::class, 'profile'])->name('user.profile');
Route::put('/profile/update', [UserProfileController::class, 'update'])->name('user.updateProfile');

Route::get('/produk', [UserProdukController::class, 'index'])->name('user.produk');
Route::get('/pemesanan', [UserPemesananController::class, 'index'])->name('user.pemesanan');
Route::post('/pemesanan/store', [UserPemesananController::class, 'store'])->name('pemesanan.store');

Route::get('/kontak', [UserKontakController::class, 'index'])->name('user.kontak');

Route::get('/produk/{produk}', [UserProdukController::class, 'show'])->name('produk.show');
Route::post('/add-to-cart/{id}', [UserProdukController::class, 'addToCart'])->name('cart.add');


// Auth::routes(['verify' => true]);
// Route::get('/cart', [CartController::class, 'index']);
// Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
// Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
// Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');


// Route::get('/get-provinces', [AuthController::class, 'getProvinces']);