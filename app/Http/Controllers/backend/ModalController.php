<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\Modal;
use App\Traits\ImageTrait;

class ModalController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Pop-up Modal';
    protected $base_route = 'modal.';
    protected $view_path = 'backend.modal.';
    protected $img_path = 'uploads/modal/';

    public function __construct()
    {
        $this->model = new Modal();
    }
    use ImageTrait;

    public function index()
    {
        $data['posts'] = $this->model->latest()->get();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx,xls,xlsx|max:2024',
        ]);

        try {
            $data = $request->except('image','file');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'modal');
                $data['image'] = $image_name;
            }

            if ($request->file('file')) {
                $file_name = $this->imageUpload($request->file, 'modal');
                $data['file'] = $file_name;
            }

            $modal = $this->model->create($data + [
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
            'image' => 'nullable|mimes:png,jpg,jpeg,pdf,doc,docx,xls,xlsx|max:2024',
        ]);

        try {
            $modal = $this->model->find($id);
            $data = $request->all();

            if ($request->file('image')) {
                deleteImage($modal->image);
                $image_name = $this->imageUpload($request->image, 'modal');
                $data['image'] = $image_name;
            }

            if ($request->file('file')) {
                deleteImage($modal->file);
                $file_name = $this->imageUpload($request->file, 'modal');
                $data['file'] = $file_name;
            }

            $modal->update($data + [
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
            $modal = $this->model->findOrFail($id);
            deleteImage($modal->image);
            deleteImage($modal->file);
            $modal->delete();
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

    public function modalStatus(Request $request)
    {
        try {
            $modal = $this->model->find($request['id']);
            $modal->status = $modal->status ? '0' : '1';
            $modal->save();
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
}
