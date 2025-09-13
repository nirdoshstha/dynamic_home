<?php

use App\Models\ScrollingText;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\backend\AlbumController;
use App\Http\Controllers\backend\ModalController;
use App\Http\Controllers\backend\VideoController;
use App\Http\Controllers\backend\NoticeController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\AboutUsController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\GalleryController;
use App\Http\Controllers\backend\MessageController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\DownloadController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\NewsEventsController;
use App\Http\Controllers\backend\AdminCreateController;
use App\Http\Controllers\backend\AlumniController;
use App\Http\Controllers\backend\GalleryPostController;
use App\Http\Controllers\backend\InformationController;
use App\Http\Controllers\backend\KindergartenController;
use App\Http\Controllers\backend\TestimonialController;
use App\Http\Controllers\backend\UsefulLinksController;
use App\Http\Controllers\backend\upload\ImageController;
use App\Http\Controllers\backend\ScrollingTextController;
use App\Http\Controllers\backend\OnlineRegisterController;

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
// Route::get('/admin/dashboard', function () {
//     return view('backend.dashboard.dashboard');
// });
Route::middleware(['auth', 'isUser'])->group(function () {});


Route::middleware(['auth', 'isSuperAdmin:allstarsms45@gmail.com'])->prefix('admin')->group(function () {
    Route::resource('admin-create', AdminCreateController::class)->names('admin_create');
});


Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //Slider
    Route::resource('slider', SliderController::class)->names('slider');
    Route::get('slider-status', [SliderController::class, 'sliderStatus'])->name('slider.status');

    //Testimonial
    Route::resource('testimonial', TestimonialController::class)->names('testimonial');
    Route::put('testimonial/update/{id}', [TestimonialController::class, 'updatePage'])->name('testimonial_page.update');
    Route::get('testimonial-status', [TestimonialController::class, 'testimonialStatus'])->name('testimonial.status');

    //Faculty & Year
    Route::resource('alumni', AlumniController::class)->names('alumni');
    Route::put('alumni/update/{id}', [AlumniController::class, 'updatePage'])->name('alumni_page.update');
    Route::get('alumni-status', [AlumniController::class, 'alumniStatus'])->name('alumni.status');

    //Category About Us
    Route::resource('category', CategoryController::class)->names('category');
    Route::get('category-status', [CategoryController::class, 'categoryStatus'])->name('category.status');
    Route::put('category-update/update/{id}', [CategoryController::class, 'updatePage'])->name('category_page.update');

    //About Us
    Route::resource('about', AboutUsController::class)->names('about');
    Route::get('about-status', [AboutUsController::class, 'aboutStatus'])->name('about.status');
    Route::put('about-update/update/{id}', [AboutUsController::class, 'updatePage'])->name('about_page.update');

    //Information
    Route::resource('information', InformationController::class)->names('information');
    Route::get('information-status', [InformationController::class, 'informationStatus'])->name('information.status');
    Route::put('information-update/update/{id}', [InformationController::class, 'updatePage'])->name('information_page.update');

    //Kindergarten
    Route::resource('kindergarten', KindergartenController::class)->names('kindergarten');
    Route::get('kindergarten-status', [KindergartenController::class, 'kindergartenStatus'])->name('kindergarten.status');
    Route::put('kindergarten-update/update/{id}', [KindergartenController::class, 'updatePage'])->name('kindergarten_page.update');


    //Message
    Route::resource('message', MessageController::class)->names('message');
    Route::get('message-status', [MessageController::class, 'messageStatus'])->name('message.status');
    Route::put('message-update/update/{id}', [MessageController::class, 'updatePage'])->name('message_page.update');


    //Setting

    Route::get('destroy-popup-image', [SettingController::class, 'destroyPopupImage'])->name('setting.delete_popup_image');
    Route::get('destroy-logo-image', [SettingController::class, 'destroyLogoImage'])->name('setting.delete_logo_image');
    Route::get('destroy-master-logo', [SettingController::class, 'destroyMasterLogo'])->name('setting.delete_master_logo');


    Route::resource('setting', SettingController::class)->names('setting')->except('show');
    Route::post('setting/social-media', [SettingController::class, 'settingSocialMedia'])->name('setting.social_media');
    Route::get('setting/social-media', [SettingController::class, 'settingSocialMediaDestroy'])->name('setting.social_media_destroy');
    Route::get('setting/google-map-status', [SettingController::class, 'settingGoogleMapStatus'])->name('setting.google_map_status');


    // Profile
    Route::resource('profile', ProfileController::class)->names('profile')->except('index');
    Route::post('/profile/social-media', [ProfileController::class, 'socialMedia'])->name('profile.social_media');
    Route::get('/profile/social-media/delete', [ProfileController::class, 'destroySocialMedia'])->name('social_media.destory');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change_password');

    //Album
    Route::resource('album', AlbumController::class)->names('album');
    Route::put('album/update/{id}', [AlbumController::class, 'updatePage'])->name('album_page.update');
    Route::get('album-status', [AlbumController::class, 'albumStatus'])->name('album.status');

    //Video
    Route::resource('video', VideoController::class)->names('video');
    Route::put('video/update/{id}', [VideoController::class, 'updatePage'])->name('video_page.update');
    Route::get('video-status', [VideoController::class, 'videoStatus'])->name('video.status');

    //Video
    Route::resource('news', NewsEventsController::class)->names('news');
    Route::put('news/update/{id}', [NewsEventsController::class, 'updatePage'])->name('news_page.update');
    Route::get('news-status', [NewsEventsController::class, 'newsStatus'])->name('news.status');

    //Notices
    Route::resource('notice', NoticeController::class)->names('notice');
    Route::put('notice/update/{id}', [NoticeController::class, 'updatePage'])->name('notice_page.update');
    Route::get('notice-status', [NoticeController::class, 'noticeStatus'])->name('notice.status');

    //Downloads
    Route::resource('download', DownloadController::class)->names('download');
    Route::put('download/update/{id}', [DownloadController::class, 'updatePage'])->name('download_page.update');
    Route::get('download-status', [DownloadController::class, 'downloadStatus'])->name('download.status');

    //Scrolling Text
    Route::resource('scrolling-text', ScrollingTextController::class)->names('scrolling_text');
    Route::put('scrolling-text/update/{id}', [ScrollingTextController::class, 'updatePage'])->name('scrolling_text_page.update');
    Route::get('scrolling-text-status', [ScrollingTextController::class, 'scrollingStatus'])->name('scrolling_text.status');

    //Useful Links
    Route::resource('useful-links', UsefulLinksController::class)->names('useful_links');
    Route::get('useful-links-status', [UsefulLinksController::class, 'usefulinksStatus'])->name('usefullink.status');

    Route::resource('modal', ModalController::class)->names('modal');
    Route::get('modal-status', [ModalController::class, 'modalStatus'])->name('modal.status');

    //Contact Us
    Route::resource('contact', ContactController::class)->names('contact');
    Route::get('contact-status', [ContactController::class, 'contactStatus'])->name('contact.status');
    Route::put('download/update/{id}', [ContactController::class, 'updatePage'])->name('contact_page.update');

    // Online Register
    Route::resource('online-register', OnlineRegisterController::class)->names('online_register');



    //Upload Other images
    Route::post('upload', [ImageController::class, 'upload'])->name('admin.upload');
    Route::get('delete/{id}', [ImageController::class, 'delete'])->name('admin.delete.image');
    Route::get('imageable-status', [ImageController::class, 'imageableStatus'])->name('imageable.status');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();
