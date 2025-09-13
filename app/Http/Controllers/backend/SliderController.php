<?php

namespace App\Http\Controllers\backend;

use App\Models\Slider;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Traits\ImageTrait;

class SliderController extends BackendBaseController
{
    protected $model;
    protected $panel ='Slider';
    protected $base_route ='slider.';
    protected $view_path ='backend.slider.';
    protected $img_path ='uploads/slider/';

    public function __construct()
    {
        $this->model = new Slider();
    }

    use ImageTrait;

    public function index(){
        $data['posts'] = $this->model->orderBy('rank','asc')->get();
        return view($this->__loadDataToView($this->view_path.'index'),compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|',
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'slider');
                $data['image'] = $image_name;
            }
            $slider = $this->model->create($data + [
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
        ]);

        try {
            $slider = $this->model->find($id);

            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($slider->image);
                $image_name = $this->imageUpload($request->image, 'slider');
                $data['image'] = $image_name;
            }

            $slider->update($data + [
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
            $slider = $this->model->findOrFail($id);

            deleteImage($slider->image);
            $slider->delete();
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

    public function sliderStatus(Request $request)
    {
        try {
            $slider = $this->model->find($request['id']);
            $slider->status = $slider->status ? '0' : '1';
            $slider->save();
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


}
