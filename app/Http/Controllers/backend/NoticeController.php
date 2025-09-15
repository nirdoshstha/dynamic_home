<?php

namespace App\Http\Controllers\backend;

use App\Models\Notice;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Traits\ImageTrait;

class NoticeController extends BackendBaseController
{
    protected $model;
    protected $panel ='Notice';
    protected $base_route ='notice.';
    protected $view_path ='backend.notice.';
    protected $img_path ='uploads/notice/';

    public function __construct()
    {
        $this->model = new Notice();
    }

    use ImageTrait;

    public function index(){
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->latest()->where('type', 'post')->get();
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
                $image_name = $this->imageUpload($request->image, 'notice');
                $data['image'] = $image_name;
            }
            $notice = $this->model->create($data + [
                'type' => $request['type'],
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
            $notice = $this->model->find($id);

            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($notice->image);
                $image_name = $this->imageUpload($request->image, 'notice');
                $data['image'] = $image_name;
            }

            $notice->update($data + [
                'type' => $request['type'],
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
            $notice = $this->model->findOrFail($id);

            deleteImage($notice->image);
            $notice->delete();
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

    public function noticeStatus(Request $request)
    {
        try {
            $notice = $this->model->find($request['id']);
            $notice->status = $notice->status ? '0' : '1';
            $notice->save();
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

     public function noticeStatusMenu(Request $request)
    {
        try {
            $notice = $this->model->where('type', 'page')->find($request['id']);
            $notice->status = $notice->status ? '0' : '1';
            $notice->save();
            $notice = $this->model->where('type', 'page')->first();
            $status = $notice->status;
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
            'title' => 'required'
        ]);

        $data['page'] = $this->model->where('type', 'page')->first();
        $page = $request->except('image');

        if ($request->hasFile('image')) {
            deleteImage($data['page']->image);
            $image_name = $this->imageUpload($request->image, 'notice');
            $data['page']->image = $image_name;
        }

        $data['page']->update($page +[
            'updated_by' =>auth()->user()->id,
        ]);

        return response()->json([
            'success_message' => $this->panel.' Updated Successfully !!!',
            'url' => route($this->base_route . 'index')
        ]);
    }
}
