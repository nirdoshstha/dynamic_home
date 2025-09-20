<?php

namespace App\Http\Controllers\backend;

use App\Models\Video;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Traits\ImageTrait;
use Illuminate\Validation\Rule;

class VideoController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Video';
    protected $base_route = 'video.';
    protected $view_path = 'backend.video.';
    protected $img_path = 'uploads/video/';

    public function __construct()
    {
        $this->model = new Video();
    }

    use ImageTrait;

    public function index()
    {
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->where('type', 'post')->get();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:videos,title',
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'video');
                $data['image'] = $image_name;
            }

            $video = $this->model->create($data + [
                'type' => $request['type'],
                'slug' => Str::slug($data['title']),
                'created_by' => auth()->user()->id,
            ]);

            return response()->json([
                'success_message' => $this->panel . ' Stored Successfully !!!',
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
            // 'title' => 'required|unique:videos,title,except,id',
            'title' => ['required', Rule::unique('videos')->ignore($id)],
        ]);

        try {
            $video = $this->model->find($id);
            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($video->image);
                $image_name = $this->imageUpload($request->image, 'video');
                $data['image'] = $image_name;
            }

            $video->update($data + [
                'type' => $request['type'],
                'slug' => Str::slug($data['title']),
                'updated_by' => auth()->user()->id,
            ]);
            return response()->json([
                'success_message' => $this->panel . ' Updated Successfully !!',
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
            $video = $this->model->findOrFail($id);

            deleteImage($video->image);
            $video->delete();
            return response()->json([
                'success_message' => $this->panel . ' Deleted Successfully !!!',
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

    public function videoStatus(Request $request)
    {
        try {
            $video = $this->model->find($request['id']);
            $video->status = $video->status ? '0' : '1';
            $video->save();
            return response()->json([
                'success_message' => $this->panel . ' Status Changed Successfully !!',
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
            'title' => 'required|string|max:55'
        ]);

        $data['page'] = $this->model->where('type', 'page')->first();
        $page = $request->except('image');


        if ($request->hasFile('image')) {
            deleteImage($data['page']->image);
            $image_name = $this->imageUpload($request->image, 'video');
            $data['page']->image = $image_name;
        }

        $data['page']->update($page + [
            'updated_by' => auth()->user()->id,
        ]);

        return response()->json([
            'success_message' => $this->panel . ' Updated Successfully !!!',
            'url' => route($this->base_route . 'index')
        ]);
    }
}
