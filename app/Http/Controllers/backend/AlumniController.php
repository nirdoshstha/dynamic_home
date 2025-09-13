<?php

namespace App\Http\Controllers\backend;

use App\Models\Alumni;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Traits\ImageTrait;

class AlumniController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Alumni';
    protected $base_route = 'alumni.';
    protected $view_path = 'backend.alumni.';
    protected $img_path = 'uploads/alumni/';

    public function __construct()
    {
        $this->model = new Alumni();
    }

    use ImageTrait;

    public function index()
    {
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->latest()->where('type', 'post')->get();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|',
            'description' => 'nullable|max:1055'
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'alumni');
                $data['image'] = $image_name;
            }
            $alumni = $this->model->create($data + [
                'type' => $request['type'],
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
            'description' => 'nullable|max:1055'
        ]);

        try {
            $alumni = $this->model->find($id);

            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($alumni->image);
                $image_name = $this->imageUpload($request->image, 'alumni');
                $data['image'] = $image_name;
            }

            $alumni->update($data + [
                'type' => $request['type'],
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
            $alumni = $this->model->findOrFail($id);

            deleteImage($alumni->image);
            $alumni->delete();
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

    public function alumniStatus(Request $request)
    {
        try {
            $alumni = $this->model->find($request['id']);
            $alumni->status = $alumni->status ? '0' : '1';
            $alumni->save();
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
            'title' => 'required'
        ]);

        $data['page'] = $this->model->where('type', 'page')->first();
        $page = $request->except('image');

        if ($request->hasFile('image')) {
            deleteImage($data['page']->image);
            $image_name = $this->imageUpload($request->image, 'alumni');
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
