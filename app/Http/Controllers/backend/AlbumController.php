<?php

namespace App\Http\Controllers\backend;

use App\Models\Album;
use App\Traits\ImageTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends BackendBaseController
{
    use ImageTrait;
    protected $model;
    protected $panel = 'Album';
    protected $base_route = 'album.';
    protected $view_path = 'backend.album.';
    protected $img_path = 'uploads/album/';

    public function __construct()
    {
        $this->model = new Album();
    }

    public function index()
    {
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->where('type', 'post')->get();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:55',
            'description' => 'nullable|max:200'
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'album');
                $data['image'] = $image_name;
            }
            $album = $this->model->create($data + [
                'type' => $request['type'],
                'slug' => Str::slug($data['title']),
                'created_by' => auth()->user()->id,
            ]);
            if (isset($request->other_image)) {
                //store multiple image
                $this->storeMultipleImage($album, $request->other_image);
            }

            // $album->save();
            return response()->json([
                'success_message' => 'Album Stored Successfully !!!',
                'url' => route($this->base_route . 'index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong....',
                'url' => route($this->base_route . 'index'),
            ]);
        }
    }

    public function edit($id)
    {
        $data['album'] = Album::find($id);
        $data['posts'] = $this->model->where('type', 'post')->get();
        return view($this->__loadDataToView($this->view_path . 'edit'), compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:55',
            'description' => 'nullable|max:200',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:1000'
        ]);

        try {
            $album = $this->model->find($id);
            $data = $request->except('image', 'files');

            if ($request->file('image')) {
                deleteImage($album->image);
                $image_name = $this->imageUpload($request->image, 'album');
                $data['image'] = $image_name;
            }

            //store multiple image
            if (isset($request->other_image)) {
                $this->storeMultipleImage($album, $request->other_image);
            }

            $album->update($data);
            return response()->json([
                'success_message' => 'Album Updated Successfully !!',
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
            $album = $this->model->findOrFail($id);
            if ($album->images->count()) {
                return response()->json([
                    'success_message' => 'You cant delete it, pls delete child data first !!!',
                    'url' => route($this->base_route . 'index')
                ]);
            }

            deleteImage($album->image);
            $album->delete();
            return response()->json([
                'success_message' => 'Album Deleted Successfully !!!',
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

    public function albumStatus(Request $request)
    {
        try {
            $album = $this->model->find($request['id']);
            $album->status = $album->status ? '0' : '1';
            $album->save();
            return response()->json([
                'success_message' => 'Album Status Changed Successfully !!',
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

        if ($request->file('image')) {
            deleteImage($data['page']->image);
            $image_name = $this->imageUpload($request->image, 'album');
            $data['page']->image = $image_name;
        }

        $data['page']->update($page);

        return response()->json([
            'success_message' => 'Album Updated Successfully !!!',
            'url' => route($this->base_route . 'index')
        ]);
    }
}
