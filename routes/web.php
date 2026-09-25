<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\RazorpayController;


Route::get('/storage/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);

    if (!file_exists($file)) {
        abort(404);
    }

    return response()->file($file);
})->where('path', '.*');


Route::get('/fix-storage', function () {
    $source = storage_path('app/public'); 
    $destination = public_path('storage'); 
 
    if (!File::exists($destination)) {
        File::makeDirectory($destination, 0755, true);
    }
 
    // Copy all files recursively
    File::copyDirectory($source, $destination);
 
    return 'All storage files copied to public/storage successfully!';
});

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/hotels', [PublicController::class, 'hotels'])->name('hotels.index');
Route::get('/hotels/{hotel}', [PublicController::class, 'hotel'])->name('hotels.show');

Route::get('/rooms', [PublicController::class, 'rooms'])->name('rooms.index');
Route::get('/rooms/{room}', [PublicController::class, 'roomShow'])->name('rooms.show');
Route::get('/rooms/{room}/book', [PublicController::class, 'book'])->name('bookings.create');
Route::post('/rooms/{room}/book', [PublicController::class, 'storeBooking'])->name('bookings.store');

Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'storeContact'])->name('contact.store');

Route::get('/blogs', [PublicController::class, 'blogs'])->name('blogs.index');
Route::get('/blogs/{slug}', [PublicController::class, 'blog'])->name('blogs.show');

Route::get('/page/{slug}', [PublicController::class, 'page'])->name('pages.show');

Route::get('/about-us', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services.index');
Route::get('/services/{slug}', [PublicController::class, 'serviceDetails'])->name('services.show');
Route::get('/offers', [PublicController::class, 'offers'])->name('offers');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/testimonials', [PublicController::class, 'testimonials'])->name('testimonials');
Route::get('/destinations', [PublicController::class, 'destinations'])->name('destinations.index');
Route::get('/destinations/{slug}', [PublicController::class, 'destinationDetails'])->name('destinations.show');

Route::get('/create-order',[RazorpayController::class,'paymentform'])->name('payment.form');
Route::post('create-order',[RazorpayController::class,'createOrder'])->name('razorpay.createOrder');
Route::post('/payment-success', [RazorpayController::class, 'paymentSuccess'])->name('razorpay.success');
Route::get('/thank-you', [RazorpayController::class, 'thank_you'])->name('thank-you');


Route::get('/packages', [PublicController::class, 'packages'])->name('packages.index');
Route::get('/packages/{slug}', [PublicController::class, 'packageShow'])->name('packages.show');
Route::post('/packages/{package}/enquire', [PublicController::class, 'storePackageEnquiry'])->name('packages.enquire');

Route::get('/privacy-policy', [PublicController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [PublicController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');

// Project Management System UI Routes
use App\Http\Controllers\PmsController;
Route::group(['prefix' => 'pms', 'as' => 'pms.'], function () {
    Route::get('/dashboard', [PmsController::class, 'dashboard'])->name('dashboard');
    Route::get('/projects', [PmsController::class, 'projects'])->name('projects.index');
    Route::get('/projects/board', [PmsController::class, 'board'])->name('projects.board');
    Route::get('/projects/show', [PmsController::class, 'projectShow'])->name('projects.show');
    Route::get('/users', [PmsController::class, 'users'])->name('users.index');
});

Auth::routes();

// Default admin home route
Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
});

use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\DestinationController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('hotels', HotelController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('enquiries', EnquiryController::class);
    Route::resource('offers', OfferController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('destinations', DestinationController::class);
    Route::resource('testimonials', TestimonialController::class);
     Route::resource('settings', SettingController::class);
    Route::post('settings/save', [SettingController::class, 'update'])->name('settings.save');
    Route::resource('packages', \App\Http\Controllers\Admin\PackageController::class);
    Route::post('packages/{package}/remove-image', [\App\Http\Controllers\Admin\PackageController::class, 'removeImage'])->name('packages.remove-image');

    // Dynamic Pages CRM
    Route::resource('pages', PageController::class);
    Route::get('pages/{page}/sections', [PageController::class, 'showSections'])->name('pages.sections');
    Route::get('pages/{page}/sections/create', [PageController::class, 'createSection'])->name('pages.sections.create');
    Route::post('pages/{page}/sections', [PageController::class, 'storeSection'])->name('pages.sections.store');
    Route::get('pages/sections/{section}/edit', [PageController::class, 'editSection'])->name('pages.sections.edit');
    Route::put('pages/sections/{section}', [PageController::class, 'updateSection'])->name('pages.sections.update');
    Route::delete('pages/sections/{section}', [PageController::class, 'destroySection'])->name('pages.sections.destroy');

    // FAQ CRUD
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);

    // Gallery CRM
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class);

    // Image Removal
    Route::post('hotels/{hotel}/remove-image', [HotelController::class, 'removeImage'])->name('hotels.remove-image');
    Route::post('rooms/{room}/remove-image', [RoomController::class, 'removeImage'])->name('rooms.remove-image');

    // CKEditor Image Upload
    Route::post('/upload-editor-image', [\App\Http\Controllers\Admin\UploadController::class, 'upload'])->name('upload.editor.image');
});
