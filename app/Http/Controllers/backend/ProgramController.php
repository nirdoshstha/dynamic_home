<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\Program;
use App\Traits\ImageTrait;

class ProgramController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Program';
    protected $base_route = 'program.';
    protected $view_path = 'backend.program.';
    protected $img_path = 'uploads/program/';

    public function __construct()
    {
        $this->model = new Program();
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
            'title' => 'required|unique:programs,title',
        ]);

        try {
            $data = $request->except('image', 'banner');

            if ($request->file('banner')) {
                $data['banner'] = $this->imageUpload($request->banner, 'program');
            }

            if ($request->file('image')) {
                $data['image'] = $this->imageUpload($request->image, 'program');
            }

            $this->model->create($data + [
                'type'       => $request->type,
                'slug'       => Str::slug($request->title),
                'created_by' => auth()->id(),
            ]);

            return response()->json([
                'success_message' => $this->panel . ' Stored Successfully !!!',
                'url'             => route($this->base_route . 'index'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong....',
                'url'           => route($this->base_route . 'index'),
            ]);
        }
    }


    public function edit(Request $request, $id)
    {
        $data['program'] = program::findOrFail($id);
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->where('type', 'post')->get();
        return view($this->__loadDataToView($this->view_path . 'edit'), compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:programs,title,' . $id,

        ]);

        try {
            $program = $this->model->find($id);

            $data = $request->except('image', 'banner');

            if ($request->file('banner')) {
                deleteImage($program->banner);
                $banner_name = $this->imageUpload($request->banner, 'program');
                $data['banner'] = $banner_name;
            }

            if ($request->file('image')) {
                deleteImage($program->image);
                $image_name = $this->imageUpload($request->image, 'program');
                $data['image'] = $image_name;
            }

            $program->update($data + [
                'type' => $request['type'],
                'slug' => Str::slug($data['title']),
                'updated_by' => auth()->user()->id,
            ]);

            //store multiple image
            // if (isset($request->other_image)) {
            //     $this->storeMultipleImage($program, $request->other_image);
            // }

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
            $program = $this->model->findOrFail($id);

            deleteImage($program->image);
            deleteImage($program->banner);
            $program->delete();
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

    public function programStatus(Request $request)
    {
        try {
            $program = $this->model->find($request['id']);
            $program->status = $program->status ? '0' : '1';
            $program->save();
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

    public function programStatusMenu(Request $request)
    {
        try {
            $program = $this->model->where('type', 'page')->find($request['id']);
            $program->status = $program->status ? '0' : '1';
            $program->save();
            $program = $this->model->where('type', 'page')->first();
            $status = $program->status;
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

        $page = $this->model->where('type', 'page')->first();
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            deleteImage($page->image);
            $image_name = $this->imageUpload($request->image, 'program');
            $page->image = $image_name;
        }

        $page->update($data + [
            'updated_by' => auth()->user()->id,
        ]);

        return response()->json([
            'success_message' => $this->panel . ' Updated Successfully !!!',
            'url' => route($this->base_route . 'index')
        ]);
    }
}
