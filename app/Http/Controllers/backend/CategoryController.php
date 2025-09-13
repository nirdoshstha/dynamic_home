<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\Category;
use App\Traits\ImageTrait;

class CategoryController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Category';
    protected $base_route = 'category.';
    protected $view_path = 'backend.about.';
    protected $img_path = 'uploads/category/';

    public function __construct()
    {
        $this->model = new Category();
    }
    use ImageTrait;

    public function index()
    {
        $data['posts'] = $this->model->orderBy('rank', 'asc')->get();
        return view($this->__loadDataToView($this->view_path . 'category-index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories,title,except,id',
            'rank' => 'required',
            'design' =>'required'
        ]);

        try {
            $data = $request->except('image');

            if ($request->file('image')) {
                $image_name = $this->imageUpload($request->image, 'about_us');
                $data['image'] = $image_name;
            }

            $category = $this->model->create($data + [
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
            'rank' => 'required',
            'design' =>'required'
        ]);

        try {
            $category = $this->model->find($id);
            $data = $request->all();

            if ($request->file('image')) {
                deleteImage($category->image);
                $image_name = $this->imageUpload($request->image, 'about_us');
                $data['image'] = $image_name;
            }

            $category->update($data + [
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
            $category = $this->model->findOrFail($id);
            deleteImage($category->image);
            $category->delete();
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

    public function categoryStatus(Request $request)
    {
        try {
            $category = $this->model->find($request['id']);
            $category->status = $category->status ? '0' : '1';
            $category->save();
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
