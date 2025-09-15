<?php

namespace App\Http\Controllers\backend;

use App\Models\Message;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Traits\ImageTrait;

class MessageController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Messages';
    protected $base_route = 'message.';
    protected $view_path = 'backend.message.';
    protected $img_path = 'uploads/message/';

    public function __construct()
    {
        $this->model = new Message();
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
            'title' => 'required|unique:messages,title',
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'message');
                $data['image'] = $image_name;
            }

            $message = $this->model->create($data + [
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
            'title' => 'required|unique:messages,title,' . $id,
        ]);

        try {
            $message = $this->model->find($id);
            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($message->image);
                $image_name = $this->imageUpload($request->image, 'message');
                $data['image'] = $image_name;
            }

            $message->update($data + [
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
            $message = $this->model->findOrFail($id);

            deleteImage($message->image);
            $message->delete();
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

    public function messageStatus(Request $request)
    {
        try {
            $message = $this->model->find($request['id']);
            $message->status = $message->status ? '0' : '1';
            $message->save();
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

    public function messageStatusMenu(Request $request)
    {
        try {
            $message = $this->model->where('type', 'page')->find($request['id']);
            $message->status = $message->status ? '0' : '1';
            $message->save();
            $message = $this->model->where('type', 'page')->first();
            $status = $message->status;
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
            $image_name = $this->imageUpload($request->image, 'message');
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
