<?php

use App\Models\About;
use App\Models\Album;
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
use App\Models\NewsEvent;
use App\Models\Notice;
use App\Models\OnlineRegistration;
use App\Models\Program;
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

if (!function_exists('informations')) {
    function informations()
    {
        $informations = Information::where('type', 'post')->where('status', '0')->get();
        return $informations;
    }
}

if (!function_exists('information')) {
    function information()
    {
        $information = Information::where('type', 'page')->first();
        return $information;
    }
}

if (!function_exists('about')) {
    function about()
    {
        $about = About::where('type', 'page')->first();
        return $about;
    }
}

if (!function_exists('kindergartens')) {
    function kindergartens()
    {
        $kindergartens = Kindergarten::where('type', 'post')->where('status', '0')->get();
        return $kindergartens;
    }
}

if (!function_exists('program')) {
    function program()
    {
        $program = Program::where('type', 'page')->first();
        return $program;
    }
}

if (!function_exists('programs')) {
    function programs()
    {
        $programs = Program::active()->where('type', 'post')->get();
        return $programs;
    }
}

if (!function_exists('messages')) {
    function messages()
    {
        $messages = Message::where('type', 'post')->where('status', '0')->get();
        return $messages;
    }
}

if (!function_exists('message')) {
    function message()
    {
        $message = Message::where('type', 'page')->first();
        return $message;
    }
}

if (!function_exists('kindergarten')) {
    function kindergarten()
    {
        $kindergarten = Kindergarten::where('type', 'page')->first();
        return $kindergarten;
    }
}


if (!function_exists('album')) {
    function album()
    {
        $album = Album::where('type', 'page')->first();
        return $album;
    }
}

if (!function_exists('news')) {
    function news()
    {
        $news = NewsEvent::where('type', 'page')->first();
        return $news;
    }
}


if (!function_exists('notice')) {
    function notice()
    {
        $notice = Notice::where('type', 'page')->first();
        return $notice;
    }
}


if (!function_exists('download')) {
    function download()
    {
        $download = Download::where('type', 'page')->first();
        return $download;
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
        $socials = General::where('type', 'setting')->orderBy('rank')->get();
        return $socials;
    }
}


if (!function_exists('downloadMenu')) {
    function downloadMenu()
    {
        $menu = General::where('type', 'download')->first();
        return $menu;
    }
}

if (!function_exists('downloads')) {
    function downloads()
    {
        $downloads = Download::active()->orderBy('rank', 'asc')->get();
        return $downloads;
    }
}

if (!function_exists('usefulllinks')) {
    function usefulllinks()
    {
        $usefulllinks = General::active()->where('type', 'useful_links')->orderBy('rank', 'asc')->get();
        return $usefulllinks;
    }
}

if (!function_exists('topnavbarlinks')) {
    function topnavbarlinks()
    {
        $topnavbarlinks = General::active()->where('type', 'top_navbar_links')->orderBy('rank', 'asc')->get();
        return $topnavbarlinks;
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
