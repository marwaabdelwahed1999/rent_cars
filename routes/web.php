<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Models\User;
use App\Http\Controllers\Admin\CarsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin  Panel routes 
// Cars routes
// Cars list
Route::get('cars', [CarsController::class, 'index'])->name('cars');

// Cars store
Route::post('storeCar', [CarsController::class, 'store'])->name('storeCar');

// Add car
Route::get('addCar', [CarsController::class, 'create'])->name('addCar');





// testmoinals   route

// testmoinals list  route
// Display Testimonials
Route::get('admin/testimonials', [TestimonialsController::class, 'index'])->name('testimonials');
// add testmoinal 
Route::match(['get', 'post'], 'admin/add-testimonial', [TestimonialsController::class,'create'])->name('add_testimonial');
 // Store Testimonial in DB
  Route::post('admin/store-testimonial',[TestimonialsController::class ,'store'])->name('store_testimonial');
// Edit Testimonial
Route::get('admin/testimonials/{id}/edit', [TestimonialsController::class, 'edit'])->name('testimonials.edit');

// Update Testimonial (Handle the form submission for editing)
Route::put('admin/testimonials/{id}', [TestimonialsController::class, 'update'])->name('testimonials.update');
// delete and restore  a testimonial
Route::get('testimonials/{id}/restore', [TestimonialsController::class, 'restore'])->name('testimonials.restore');
Route::get('testimonials/trashed', [TestimonialsController::class, 'trashed'])->name('testimonials.trashed');
Route::delete('admin/testimonials/{testimonial}/force-delete', [TestimonialsController::class, 'forceDelete'])->name('admin.testimonials.forceDelete');
Route::delete('testimonials/{testimonial}/delete', [TestimonialsController::class, 'destroy'])->name('testimonials.destroy');
// upload image
Route::post('uploadImage',[TestimonialsController::class,'uploadImage'])->name('uploadImage');    

