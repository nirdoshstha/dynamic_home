<?php

use App\Http\Controllers\frontend\FrontendController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

//Informations
Route::get('information/{slug}', [FrontendController::class, 'information'])->name('frontend.information');


//Kindergartes
Route::get('kindergarten/{slug}', [FrontendController::class, 'kindergarten'])->name('frontend.kindergarten');

//Alumni
Route::get('alumni', [FrontendController::class, 'alumni'])->name('frontend.alumni');


//Messages
Route::get('message/{slug}', [FrontendController::class, 'messages'])->name('frontend.message');

//About Us
Route::get('about-us/{slug}', [FrontendController::class, 'aboutUs'])->name('frontend.about_us');
Route::get('about-us', [FrontendController::class, 'aboutSingle'])->name('frontend.about_single');


//Photo Album
Route::get('photo-album', [FrontendController::class, 'photoAlbum'])->name('frontend.photo_album');

//Album Photo Gallery
Route::get('gallery/{album_slug}', [FrontendController::class, 'photoAlbumGallery'])->name('frontend.photo_album_gallery');

//Video
Route::get('video-gallery', [FrontendController::class, 'videoGallery'])->name('frontend.video');

//News & Events
Route::get('news-and-events', [FrontendController::class, 'newsAndEvents'])->name('frontend.news_events');

//Notice
Route::get('notice', [FrontendController::class, 'noticeAll'])->name('frontend.notice');

//Contact Us
Route::get('contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::post('send-message', [FrontendController::class, 'sendMessage'])->name('frontend.send_message');
Route::get('reload-captcha', [FrontendController::class, 'reloadCaptcha']);

//Online Form Register
Route::get('online-register', [FrontendController::class, 'onlineRegister'])->name('frontend.online_register');
Route::post('online-register/store', [FrontendController::class, 'onlineRegisterStore'])->name('frontend.online_register_store');
