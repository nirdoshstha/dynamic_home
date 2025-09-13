<?php

namespace App\Http\Controllers\backend;

use App\Models\ContactUs;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Traits\ImageTrait;

class ContactController extends BackendBaseController
{
    protected $model;
    protected $panel ='Contact Us';
    protected $base_route ='contact.';
    protected $view_path ='backend.contact.';
    protected $img_path ='uploads/contact/';

    public function __construct()
    {
        $this->model = new ContactUs();
    }

    use ImageTrait;

    public function index(){
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->where('type', 'post')->get();
        return view($this->__loadDataToView($this->view_path.'index'),compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'contact');
                $data['image'] = $image_name;
            }
            $contact = $this->model->create($data + [
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
            'name' => 'required',
        ]);

        try {
            $contact = $this->model->find($id);

            $data = $request->except('image');

            if ($request->file('image')) {
                deleteImage($contact->image);
                $image_name = $this->imageUpload($request->image, 'contact');
                $data['image'] = $image_name;
            }

            $contact->update($data + [
                'type' => $request['type'],
                'slug' => Str::slug($data['name']),
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
            $contact = $this->model->findOrFail($id);

            deleteImage($contact->image);
            $contact->delete();
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

    

}
