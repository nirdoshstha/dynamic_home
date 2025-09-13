<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\About;
use App\Models\Category;
use App\Traits\ImageTrait;

class AboutUsController extends BackendBaseController
{
    protected $model;
    protected $panel = 'About Us';
    protected $base_route = 'about.';
    protected $view_path = 'backend.about.';
    protected $img_path = 'uploads/about/';

    public function __construct()
    {
        $this->model = new About();
    }
    use ImageTrait;

    public function index()
    {
        $data['page'] = $this->model->where('type', 'page')->first();
        $data['posts'] = $this->model->where('type', 'post')->orderBy('rank', 'asc')->get();
        $data['categories'] = Category::latest()->get();
        return view($this->__loadDataToView($this->view_path . 'post-index'), compact('data'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|',
            'category_id' => $request->type=='post' ? 'required' : 'nullable',
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'about_us');
                $data['image'] = $image_name;
            }
            $abouts = $this->model->create($data + [
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
            'name' => 'required',
            'category_id' => $request->type=='post' ? 'required' : 'nullable',
        ]);

        try {
            $abouts = $this->model->find($id);
            $data = $request->all();

            if ($request->file('image')) {
                deleteImage($abouts->image);
                $image_name = $this->imageUpload($request->image, 'about_us');
                $data['image'] = $image_name;
            }
            $abouts->update($data + [
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
            $abouts = $this->model->findOrFail($id);
            deleteImage($abouts->image);
            $abouts->delete();
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

    public function aboutStatus(Request $request)
    {
        try {
            $abouts = $this->model->find($request['id']);
            $abouts->status = $abouts->status ? '0' : '1';
            $abouts->save();
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
            'name' => 'required'
        ]);

        $data['page'] = $this->model->where('type', 'page')->first();
        $page = $request->except('image');

        if ($request->hasFile('image')) {
            deleteImage($data['page']->image);
            $image_name = $this->imageUpload($request->image, 'about_us');
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
