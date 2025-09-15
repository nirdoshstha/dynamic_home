<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\Download;
use App\Models\General;
use App\Traits\ImageTrait;

class DownloadController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Download';
    protected $base_route = 'download.';
    protected $view_path = 'backend.download.';
    protected $img_path = 'uploads/download/';

    public function __construct()
    {
        $this->model = new Download();
    }
    use ImageTrait;

    public function index()
    {
        $data = [];
        $data['menu'] = General::where('type', 'download')->first();
        $data['posts'] = $this->model->orderBy('rank', 'asc')->get();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories,title,except,id',
            'image' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx,xls,xlsx|max:4096',
            'rank' => 'required'
        ]);

        try {
            $data = $request->except('image', 'cover_image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'download');
                $data['image'] = $image_name;
            }

            if ($request->file('cover_image')) {
                $cover_image_name = $this->imageUpload($request->cover_image, 'download');
                $data['cover_image'] = $cover_image_name;
            }

            $download = $this->model->create($data + [
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
            'image' => 'nullable|mimes:png,jpg,jpeg,pdf,doc,docx,xls,xlsx|max:2024',
        ]);

        try {
            $download = $this->model->find($id);
            $data = $request->all();

            if ($request->file('image')) {
                deleteImage($download->image);
                $image_name = $this->imageUpload($request->image, 'download');
                $data['image'] = $image_name;
            }

            if ($request->file('cover_image')) {
                deleteImage($download->cover_image);
                $cover_image_name = $this->imageUpload($request->cover_image, 'download');
                $data['cover_image'] = $cover_image_name;
            }

            $download->update($data + [
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
            $download = $this->model->findOrFail($id);
            deleteImage($download->image);
            $download->delete();
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

    public function downloadStatus(Request $request)
    {
        try {
            $download = $this->model->find($request['id']);
            $download->status = $download->status ? '0' : '1';
            $download->save();
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

    public function downloadMenuStatus(Request $request)
    {
        try {
            $id = $request['id'];

            $download = General::updateOrCreate([
                'id' => $id ?? null,
            ], [
                'type' => 'download',
                'user_id' => auth()->user()->id,
                'status'     =>  $id ? (General::find($id)->status ? '0' : '1') : '1',
                $id ? 'updated_by' : 'created_by' => auth()->user()->id,
            ]);

            $status = $download->status;

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
}
