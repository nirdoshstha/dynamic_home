<?php

namespace App\Http\Controllers\backend;

use App\Models\NewsEvent;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Traits\ImageTrait;

class NewsEventsController extends BackendBaseController
{
    protected $model;
    protected $panel = 'News And Events';
    protected $base_route = 'news.';
    protected $view_path = 'backend.news.';
    protected $img_path = 'uploads/news/';

    public function __construct()
    {
        $this->model = new NewsEvent();
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
            'title' => 'required',
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'news');
                $data['image'] = $image_name;
            }

            $news = $this->model->create($data + [
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
            'title' => 'required',
        ]);

        try {
            $news = $this->model->find($id);
            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($news->image);
                $image_name = $this->imageUpload($request->image, 'news');
                $data['image'] = $image_name;
            }

            $news->update($data + [
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
            $news = $this->model->findOrFail($id);

            deleteImage($news->image);
            $news->delete();
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

    public function newsStatus(Request $request)
    {
        try {
            $news = $this->model->find($request['id']);
            $news->status = $news->status ? '0' : '1';
            $news->save();
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


    public function newsStatusMenu(Request $request)
    {
        try {
            $news = $this->model->where('type', 'page')->find($request['id']);
            $news->status = $news->status ? '0' : '1';
            $news->save();
            $news = $this->model->where('type', 'page')->first();
            $status = $news->status;
            return response()->json([
                'success_message' => $this->panel . ' Menu Status Changed Successfully !!',
                'url' => route($this->base_route . 'index'),
                'status_update' => $status,
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
            $image_name = $this->imageUpload($request->image, 'news');
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
