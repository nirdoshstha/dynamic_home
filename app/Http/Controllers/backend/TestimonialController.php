<?php

namespace App\Http\Controllers\backend;

use App\Models\Testimonial;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Traits\ImageTrait;

class TestimonialController extends BackendBaseController
{
    protected $model;
    protected $panel ='Testimonial';
    protected $base_route ='testimonial.';
    protected $view_path ='backend.testimonial.';
    protected $img_path ='uploads/testimonial/';

    public function __construct()
    {
        $this->model = new Testimonial();
    }

    use ImageTrait;

    public function index(){
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->latest()->where('type', 'post')->get();
        return view($this->__loadDataToView($this->view_path.'index'),compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|',
            'description' =>'required|max:355'
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'testimonial');
                $data['image'] = $image_name;
            }
            $testimonial = $this->model->create($data + [
                'type' => $request['type'],
                'created_by' => auth()->user()->id,
            ]);
            return response()->json([
                'success_message' => $this->panel.' Stored Successfully !!!',
                'url' => route($this->base_route . 'index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong....',
                'url' => route($this->base_route . 'index'),
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
             'description' =>'required|max:355'
        ]);

        try {
            $testimonial = $this->model->find($id);

            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($testimonial->image);
                $image_name = $this->imageUpload($request->image, 'testimonial');
                $data['image'] = $image_name;
            }

            $testimonial->update($data + [
                'type' => $request['type'],
                'updated_by' =>auth()->user()->id,
            ]);
            return response()->json([
                'success_message' => $this->panel.' Updated Successfully !!',
                'url' => route($this->base_route . 'index'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong..',
                'url' => route($this->base_route . 'index'),
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $testimonial = $this->model->findOrFail($id);

            deleteImage($testimonial->image);
            $testimonial->delete();
            return response()->json([
                'success_message' => $this->panel.' Deleted Successfully !!!',
                'url' => route($this->base_route . 'index')
            ]);
        } catch (\Exception $e) {
            // Session()->flash('error_message','Something went wrong..');
            return response()->json([
                'error_message' => 'Something Went Wrong....',
                'url' => route($this->base_route . 'index'),
            ]);
        }
    }

    public function testimonialStatus(Request $request)
    {
        try {
            $testimonial = $this->model->find($request['id']);
            $testimonial->status = $testimonial->status ? '0' : '1';
            $testimonial->save();
            return response()->json([
                'success_message' => $this->panel.' Status Changed Successfully !!',
                'url' => route($this->base_route . 'index'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong..',
            ]);
        }
    }

    public function updatePage(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $data['page'] = $this->model->where('type', 'page')->first();
        $page = $request->except('image');

        if ($request->hasFile('image')) {
            deleteImage($data['page']->image);
            $image_name = $this->imageUpload($request->image, 'testimonial');
            $data['page']->image = $image_name;
        }

        $data['page']->update($page +[
            'updated_by' =>auth()->user()->id,
        ]);

        return response()->json([
            'success_message' => $this->panel.' Updated Successfully !!!',
            'url' => route($this->base_route . 'index')
        ]);
    }
}
