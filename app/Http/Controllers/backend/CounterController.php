<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\General;

class CounterController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Counter';
    protected $base_route = 'counter.';
    protected $view_path = 'backend.counter.';
    protected $img_path = 'uploads/counter/';

    public function __construct()
    {
        $this->model = new General();
    }

    public function index()
    {
        $data['posts'] = $this->model->where('type', 'counter')->orderBy('rank', 'asc')->get();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'required',
            'rank' => 'required',
        ]);

        try {
            $data = $request->all();

            $counter = $this->model->create($data + [
                'type' => 'counter',
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
            'link' => 'required',
            'rank' => 'required',
        ]);

        try {
            $counter = $this->model->find($id);
            $data = $request->all();

            $counter->update($data + [
                'type' => 'counter',
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
            $counter = $this->model->findOrFail($id);
            $counter->delete();
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

    public function counterStatus(Request $request)
    {
        try {
            $counter = $this->model->find($request['id']);
            $counter->status = $counter->status ? '0' : '1';
            $counter->save();
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
