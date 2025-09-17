<?php

namespace App\Http\Controllers\frontend;

use App\Models\About;
use App\Models\Album;
use App\Models\Video;
use App\Models\Notice;
use App\Models\Message;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Imageable;
use App\Models\NewsEvent;
use App\Traits\ImageTrait;
use App\Models\Information;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\OnlineRegistration;
use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Download;
use App\Models\Kindergarten;
use Illuminate\Contracts\Session\Session;

class FrontendController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $data['about_page'] = About::where('type', 'page')->firstOrFail();

        $data['message'] = Message::where('type', 'page')->firstOrFail();
        $data['messages'] = Message::active()->latest()->where('type', 'post')->get();

        $data['news_event'] = NewsEvent::where('type', 'page')->firstOrFail();
        $data['news_events'] = NewsEvent::active()->latest()->where('type', 'post')->get();
        $data['notices'] = Notice::active()->latest()->where('type', 'post')->take(10)->get();

        $data['galleries'] = Imageable::where('status', 0)->where('imageable_type', 'App\Models\Album')->inRandomOrder()->take(14)->get();
        $data['albums'] = Album::active()->latest()->where('type', 'post')->paginate(12);
        $data['album'] = Album::where('type', 'page')->firstOrFail();

        $data['videos'] = Video::active()->latest()->where('type', 'post')->take(3)->get();
        $data['video'] = Video::where('type', 'page')->firstOrFail();

        $data['testimonial'] = Testimonial::where('type', 'page')->firstOrFail();
        $data['testimonials'] = Testimonial::active()->where('type', 'post')->get();

        return view('frontend.index', compact('data'));
    }

    public function information($slug)
    {
        $data['page'] = Information::where('type', 'page')->firstOrFail();
        $data['information'] = Information::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.information', compact('data'));
    }

    public function kindergarten($slug)
    {
        $data['page'] = Kindergarten::where('type', 'page')->firstOrFail();
        $data['kindergarten'] = Kindergarten::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.kindergarten', compact('data'));
    }

    public function alumni()
    {
        $data['alumni'] = Alumni::where('type', 'page')->firstOrFail();
        $data['alumnies'] = Alumni::active()->where('type', 'post')->paginate(12);

        return view('frontend.pages.alumni', compact('data'));
    }

    public function messages($slug)
    {
        $data['page'] = Message::where('type', 'page')->firstOrFail();
        $data['message'] = Message::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.message', compact('data'));
    }

    public function aboutUs($slug)
    {
        $data['categories'] = Category::active()->where('slug', $slug)->firstOrFail();
        $data['posts'] = $data['categories']?->posts;
        return view('frontend.pages.about-us', compact('data'));
    }

    public function aboutSingle()
    {
        // $data['about'] = About::where('type', 'page')->firstOrFail();
        $data['about_page'] = About::where('type', 'page')->firstOrFail();
        return view('frontend.pages.about-single', compact('data'));
    }

    public function photoAlbum()
    {
        $data['page'] = Album::where('type', 'page')->firstOrFail();
        $data['albums'] = Album::active()->latest()->where('type', 'post')->paginate(12);
        return view('frontend.pages.photo-album', compact('data'));
    }

    public function photoAlbumGallery($album_slug)
    {
        $data['page'] = Album::where('type', 'page')->firstOrFail();
        $data['album'] = Album::where('slug', $album_slug)->firstOrFail();
        return view('frontend.pages.gallery', compact('data'));
    }

    public function videoGallery()
    {
        $data['page'] = Video::where('type', 'page')->firstOrFail();
        $data['video'] = Video::latest()->where('type', 'post')->paginate(6);
        return view('frontend.pages.video', compact('data'));
    }

    public function newsAndEvents()
    {
        $data['page'] = NewsEvent::where('type', 'page')->firstOrFail();
        $data['news'] = NewsEvent::active()->latest()->where('type', 'post')->paginate(6);
        return view('frontend.pages.news-events', compact('data'));
    }

    public function noticeAll()
    {
        $data['page'] = Notice::where('type', 'page')->firstOrFail();
        $data['notice'] = Notice::active()->latest()->where('type', 'post')->paginate(10);
        return view('frontend.pages.notice', compact('data'));
    }

    public function download()
    {
        $data['downloads'] = Download::active()->latest()->paginate(12);
        return view('frontend.pages.download', compact('data'));
    }

    public function contact()
    {
        $data['contact'] = ContactUs::where('type', 'page')->firstOrFail();

        return view('frontend.pages.contact', compact('data'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required',
            'message' => 'required|max:500',
            'captcha' => 'required|captcha'
        ]);

        try {
            $data = $request->all();
            $contact = ContactUs::create($data + [
                'type' => 'post'
            ]);

            return back()->with('status', 'Thank you for your message, we will get back you soon.');
        } catch (\Exception $e) {
            return back()->with('status', 'Somethig went wrong.');
        }
    }

    public function reloadCaptcha()
    {
        return response()->json([
            'captcha' => captcha_img('math'),
        ]);
    }

    public function onlineRegister()
    {
        return view('frontend.pages.online-register');
    }

    public function onlineRegisterStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:22',
            'grade' => 'required',
            'current_grade' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'captcha' => 'required|captcha'
        ]);
        try {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $image_name = $this->imageUpload($request->image, 'registration');
                $data['image'] = $image_name;
            }

            $register = OnlineRegistration::create($data);
            return response()->json([
                'success_message' => 'Thank you for your submit, we will contact u soon.',
                'url' => route('frontend.online_register')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong !!',
                'url' => route('frontend.online_register'),
            ]);
        }
    }
}
