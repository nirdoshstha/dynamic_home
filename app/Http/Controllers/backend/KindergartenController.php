<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\Kindergarten;
use App\Traits\ImageTrait;

class KindergartenController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Kindergarten';
    protected $base_route = 'kindergarten.';
    protected $view_path = 'backend.kindergarten.';
    protected $img_path = 'uploads/kindergarten/';

    public function __construct()
    {
        $this->model = new Kindergarten();
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
            'title' => 'required|unique:kindergartens,title',
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'kindergarten');
                $data['image'] = $image_name;
            }
            $kindergarten = $this->model->create($data + [
                'type' => $request['type'],
                'slug' => Str::slug($data['title']),
                'created_by' => auth()->user()->id,
            ]);

            if (isset($request->other_image)) {
                //store multiple image
                $this->storeMultipleImage($kindergarten, $request->other_image);
            }
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

    public function edit(Request $request, $id)
    {
        $data['kindergarten'] =  $this->model->findOrFail($id);
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->where('type', 'post')->get();
        return view($this->__loadDataToView($this->view_path . 'edit'), compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        try {
            $kindergarten = $this->model->find($id);

            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($kindergarten->image);
                $image_name = $this->imageUpload($request->image, 'kindergarten');
                $data['image'] = $image_name;
            }

            $kindergarten->update($data + [
                'type' => $request['type'],
                'slug' => Str::slug($data['title']),
                'updated_by' => auth()->user()->id,
            ]);

            //store multiple image
            if (isset($request->other_image)) {
                $this->storeMultipleImage($kindergarten, $request->other_image);
            }

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
            $kindergarten = $this->model->findOrFail($id);

            deleteImage($kindergarten->image);
            $kindergarten->delete();
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

    public function kindergartenStatus(Request $request)
    {
        try {
            $kindergarten = $this->model->find($request['id']);
            $kindergarten->status = $kindergarten->status ? '0' : '1';
            $kindergarten->save();
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
            $image_name = $this->imageUpload($request->image, 'kindergarten');
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
