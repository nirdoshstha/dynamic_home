<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\AdminCreateMailaible;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminCreateController extends BackendBaseController
{
    private $model;
    protected $panel = 'Admin Create';
    protected $base_route = 'admin_create.';
    protected $view_path = 'backend.admin_create.';
    protected $img_path = 'uploads/admin_create/';

    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {
        $data['rows'] = User::latest()->where('user_role', '!=', '2')->get();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'username' => 'required', 'string', 'unique:users',
            'email' => 'required|string|unique:users,email,except,id',
        ]);

        try {
            $admin = User::create($request->all() + [
                'user_role' => '1', //1=Admin
                'password' => Hash::make('12345'),
            ]);

            if($admin){
                $contact = [
                    'name' =>$request->name,
                    'email' =>$request->email,
                    'username' =>$request->username,
                    'password'=>'12345'
                ];

                $admin_user = $contact['email'];
                Mail::to($admin_user)->send(new AdminCreateMailaible($contact));
            }
            // return redirect()->back()->with('success_message', 'Admin Added Successfully !!');
            return response()->json([
                'success_message' => 'Admin Added Successfully !!',
                'url' => route($this->base_route . 'index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong !!',
                'url' => route($this->base_route . 'index')
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        try {
            $user->update([
                'user_role' => $request['user_role'],
                'is_banned' => $request['is_banned'],
                'updated_by' => auth()->user()->id,
            ]);
            return redirect()->back()->with('success_message', 'Admin Updated Successfully !!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Something Went Wrong !!');
        }
    }
}
