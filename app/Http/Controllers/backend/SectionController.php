<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use App\Models\General;
use Illuminate\Validation\Rule;

class SectionController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Section Rank';
    protected $base_route = 'section.';
    protected $view_path = 'backend.section.';
    protected $img_path = 'uploads/section/';

    public function __construct()
    {
        $this->model = new General();
    }

    public function index()
    {
        $data['posts'] = $this->model->where('type', 'section_rank')->orderBy('rank', 'asc')->get();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:generals,name',
            'rank' => 'required',
        ]);

        try {
            $data = $request->all();

            $section = $this->model->create($data + [
                // 'link' => Str::remove(' ', '_', Str::camel($request->name)),
                // 'link' => Str::remove('_', Str::camel($request->name)),
                'link' => ucfirst(str_replace('_', ' ', str_replace(' ', ' ', $request->name))),
                'type' => 'section_rank',
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
            'name' => ['required', Rule::unique('generals')->ignore($id)],
            'rank' => 'required',
        ]);

        try {
            $section = $this->model->find($id);
            $data = $request->all();

            $section->update($data + [
                'link' => ucfirst(str_replace('_', ' ', str_replace(' ', ' ', $request->name))),
                'type' => 'section_rank',
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
            $section = $this->model->findOrFail($id);
            $section->delete();
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

    public function sectionStatus(Request $request)
    {
        try {
            $section = $this->model->find($request['id']);
            $section->status = $section->status ? '0' : '1';
            $section->save();
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
