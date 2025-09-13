<?php

namespace App\Http\Controllers\backend;

use App\Models\Information;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Traits\ImageTrait;

class InformationController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Information';
    protected $base_route = 'information.';
    protected $view_path = 'backend.information.';
    protected $img_path = 'uploads/information/';

    public function __construct()
    {
        $this->model = new Information();
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
            'title' => 'required|unique:information,title',
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'information');
                $data['image'] = $image_name;
            }
            $information = $this->model->create($data + [
                'type' => $request['type'],
                'slug' => Str::slug($data['title']),
                'created_by' => auth()->user()->id,
            ]);

            if (isset($request->other_image)) {
                //store multiple image
                $this->storeMultipleImage($information, $request->other_image);
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
        $data['information'] = Information::findOrFail($id);
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->where('type', 'post')->get();
        return view($this->__loadDataToView($this->view_path . 'edit'), compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:information,title,' . $id,

        ]);

        try {
            $information = $this->model->find($id);

            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($information->image);
                $image_name = $this->imageUpload($request->image, 'information');
                $data['image'] = $image_name;
            }

            $information->update($data + [
                'type' => $request['type'],
                'slug' => Str::slug($data['title']),
                'updated_by' => auth()->user()->id,
            ]);

            //store multiple image
            if (isset($request->other_image)) {
                $this->storeMultipleImage($information, $request->other_image);
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
            $information = $this->model->findOrFail($id);

            deleteImage($information->image);
            $information->delete();
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

    public function informationStatus(Request $request)
    {
        try {
            $information = $this->model->find($request['id']);
            $information->status = $information->status ? '0' : '1';
            $information->save();
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
            $image_name = $this->imageUpload($request->image, 'information');
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
