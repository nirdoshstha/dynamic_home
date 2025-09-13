<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\General;

class UsefulLinksController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Useful Links';
    protected $base_route = 'useful_links.';
    protected $view_path = 'backend.useful_links.';
    protected $img_path = 'uploads/useful_links/';

    public function __construct()
    {
        $this->model = new General();
    }

    public function index()
    {
        $data['posts'] = $this->model->where('type','useful_links')->orderBy('rank', 'asc')->get();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'rank' => 'required',
        ]);

        try {
            $data = $request->all();

            $usefullinks = $this->model->create($data + [
                'type' =>'useful_links',
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
            'link' => 'required',
            'rank' => 'required',
        ]);

        try {
            $usefullinks = $this->model->find($id);
            $data = $request->all();

            $usefullinks->update($data + [
                'type' =>'useful_links',
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
            $usefullinks = $this->model->findOrFail($id);
            $usefullinks->delete();
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

    public function usefulinksStatus(Request $request)
    {
        try {
            $usefullinks = $this->model->find($request['id']);
            $usefullinks->status = $usefullinks->status ? '0' : '1';
            $usefullinks->save();
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
