<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\ScrollingText;
use App\Traits\ImageTrait;

class ScrollingTextController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Scrolling Text';
    protected $base_route = 'scrolling_text.';
    protected $view_path = 'backend.scrolling-text.';
    protected $img_path = 'uploads/scrolling-text/';

    public function __construct()
    {
        $this->model = new ScrollingText();
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
            'description' => 'required', 
        ]);

        try {
            $data = $request->except('image');

            
            $scrolling = $this->model->create($data + [ 
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
            'description' => 'required', 
        ]);

        try {
            $scrolling = $this->model->find($id);
            $data = $request->all(); 

            $scrolling->update($data + [ 
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
            $scrolling = $this->model->findOrFail($id); 
            $scrolling->delete();
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

    public function scrollingStatus(Request $request)
    {
        try {
            $scrolling = $this->model->find($request['id']);
            $scrolling->status = $scrolling->status ? '0' : '1';
            $scrolling->save();
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
