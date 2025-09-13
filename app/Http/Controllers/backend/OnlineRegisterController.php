<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OnlineRegistration;
use Illuminate\Http\Request;

class OnlineRegisterController extends BackendBaseController
{
    protected $model;
    protected $panel = 'Online Register';
    protected $base_route = 'online_register.';
    protected $view_path = 'backend.online_register.';

    public function __construct()
    {
        $this->model = new OnlineRegistration();
    }
    public function index(){
        $data['students'] = OnlineRegistration::latest()->get();
        return view($this->__loadDataToView($this->view_path.'index'),compact('data'));
    }

    public function destroy(Request $request, $id)
    {
        try {
            $register = $this->model->findOrFail($id);

            deleteImage($register->image);
            $register->delete();
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
