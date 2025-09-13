<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\General;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends BackendBaseController
{
    private $model;
    protected $panel = 'User Profile';
    protected $base_route = 'profile.';
    protected $view_path = 'backend.profile.';
    protected $img_path = 'uploads/profile/';

    public function __construct()
    {
        $this->model = new Profile();
    }

    public function create()
    {
        $auth_id = auth()->user()->id;

        if (Profile::exists()) {
            $data['profile'] = $this->model->where('user_id', $auth_id)->first();
        }
        $data['socials'] = General::where('type','profile')
        ->where('profile_id',$data['profile']->id ?? '')
        ->orderBy('rank','asc')
        ->get();
        return view($this->__loadDataToView($this->view_path . 'create'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([ 
            'company' =>'required|string|max:55'
        ]);
        try {
            DB::beginTransaction();
            $auth_id = $request['auth_id'];

            $user = User::where('id', $auth_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);


            $data = $request->except('image');

            $profile = Profile::create($request->all() + [
                'user_id' => $auth_id,
                'created_by' =>$auth_id,
            ]);

            if ($request->hasFile('image')) {
                $image_name = $this->uploadImage($request->image);
                $profile['image'] = $image_name;
            }
            $profile->save();
            DB::commit();
            // return redirect()->back()->with('success_message','Profile Stored Successfully !!');
            return response()->json([
                'url' => route($this->base_route . 'create'),
                'success_message' => 'Profile Added Successfully !!..'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // session()->flash('error_message','Something Went Wrong !!');
            return response()->json([
                'url' => route($this->base_route . 'create'),
                'error_message' => 'Something Went Wrong !!..'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([ 
            'company' =>'required|string|max:55'
        ]);
        try {
            DB::beginTransaction();
            $auth_id = $request['auth_id'];

            $user = User::where('id', $auth_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $profile = Profile::find($id);
            $data = $request->except('image');

            $profile->update($data + [
                'user_id' => $auth_id,
                'updated_by' =>$auth_id,
            ]);

            if ($request->hasFile('image')) {
                $this->deleteImage($profile->image);
                $image_name = $this->uploadImage($request->image);
                $profile['image'] = $image_name;
            }
            $profile->save();
            DB::commit();
            // return redirect()->back()->with('success_message','Profile Stored Successfully !!');
            return response()->json([
                'url' => route($this->base_route . 'create'),
                'success_message' => 'Profile Updated Successfully !!..'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // session()->flash('error_message','Something Went Wrong !!');
            return response()->json([
                'url' => route($this->base_route . 'create'),
                'error_message' => 'Something Went Wrong !!..'
            ]);
        }
    }

    public function socialMedia(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $user_id = $request['auth_id'];
            $social_media_id =$request['social_id'];


            foreach ((array) $request['name'] as $index => $social) {
                $social = General::updateOrcreate([
                    'id' =>$social_media_id[$index] ?? null,
                ],[
                    'user_id'   => auth()->user()->id,
                    'type' => 'profile',
                    'profile_id' =>$request['profile_id'],
                    'name'      => $request['name'][$index],
                    'link'     => $request['link'][$index],
                    'icon'     => $request['icon'][$index],
                    'rank'     => $request['rank'][$index],
                    'created_by' =>auth()->user()->id
                ]);
            }
            return response()->json([
                'success_message' => 'Profile Social Media Stored Successfully !!..',
                'url' => route($this->base_route . 'create'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong !!..',
                'url' => route($this->base_route . 'create'),
            ]);
        }
    }

    public function destroySocialMedia(Request $request){

        $social = General::find($request['id']);
        $social->delete();
        return response()->json([
            'success_message' =>'Social Media Deleted Successfully !!..',
        ]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user_id = $request['auth_id'];
            $user = User::where('id', $user_id)->first();

            $user->update([
                'password' => Hash::make($request['new_password']),
            ]);
            return response()->json([
                'url' => route($this->base_route . 'create'),
                'success_message' => 'User Password Changed Successfully !!..'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'url' => route($this->base_route . 'create'),
                'error_message' => 'Something Went Wrong !!..'
            ]);
        }
    }
}
