<?php

use App\Models\About;
use App\Models\Modal;
use App\Models\Slider;
use App\Models\General;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Download;
use App\Models\Information;
use App\Models\Kindergarten;
use App\Models\OnlineRegistration;
use App\Models\ScrollingText;
use Illuminate\Support\Facades\File;


function image_path($path)
{
    return asset('storage/' . $path);
}
function raw_image_path($path)
{
    return public_path('storage/' . $path);
}
function deleteImage($image)
{
    if ($image && File::exists(raw_image_path($image))) {
        unlink(raw_image_path($image));
    }
}

if (!function_exists('information')) {
    function information()
    {
        $informations = Information::where('type', 'post')->where('status', '0')->get();
        return $informations;
    }
}

if (!function_exists('kindergarten')) {
    function kindergarten()
    {
        $kindergartens = Kindergarten::where('type', 'post')->where('status', '0')->get();
        return $kindergartens;
    }
}

if (!function_exists('message')) {
    function message()
    {
        $messages = Message::where('type', 'post')->where('status', '0')->get();
        return $messages;
    }
}

if (!function_exists('category_abouts')) {
    function category_abouts()
    {
        $categories = Category::active()->orderBy('rank', 'asc')->get();
        return $categories;
    }
}

if (!function_exists('sliders')) {
    function sliders()
    {
        $sliders = Slider::active()->latest()->get();
        return $sliders;
    }
}

if (!function_exists('setting')) {
    function setting()
    {
        $setting = Setting::first();
        return $setting;
    }
}

if (!function_exists('social_media')) {
    function social_media()
    {
        $socials = General::where('type', 'setting')->get();
        return $socials;
    }
}

if (!function_exists('downloads')) {
    function downloads()
    {
        $download = Download::active()->orderBy('rank', 'asc')->get();
        return $download;
    }
}

if (!function_exists('usefulllinks')) {
    function usefulllinks()
    {
        $usefulllinks = General::active()->where('type', 'useful_links')->orderBy('rank', 'asc')->get();
        return $usefulllinks;
    }
}

if (!function_exists('modals')) {
    function modals()
    {
        $modal = Modal::active()->get();
        return $modal;
    }
}

if (!function_exists('countContact')) {
    function countContact()
    {
        $count_contact = ContactUs::where('type', 'post')->count();
        return $count_contact;
    }
}

if (!function_exists('countRegister')) {
    function countRegister()
    {
        $count_register = OnlineRegistration::count();
        return $count_register;
    }
}

if (!function_exists('scrolling')) {
    function scrolling()
    {
        $scrolling = ScrollingText::active()->latest()->get();
        return $scrolling;
    }
}
