<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\General;

class TopNavbarLinkController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Top Links';
    protected $base_route = 'top_navbar_links.';
    protected $view_path = 'backend.top_navbar_links.';
    protected $img_path = 'uploads/top_navbar_links/';

    public function __construct()
    {
        $this->model = new General();
    }

    public function index()
    {
        $data['posts'] = $this->model->where('type', 'top_navbar_links')->orderBy('rank', 'asc')->get();
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

            $topnavbar = $this->model->create($data + [
                'type' => 'top_navbar_links',
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
            $topnavbar = $this->model->find($id);
            $data = $request->all();

            $topnavbar->update($data + [
                'type' => 'top_navbar_links',
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
            $topnavbar = $this->model->findOrFail($id);
            $topnavbar->delete();
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

    public function topNavbarLinkStatus(Request $request)
    {
        try {
            $topnavbar = $this->model->find($request['id']);
            $topnavbar->status = $topnavbar->status ? '0' : '1';
            $topnavbar->save();
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
