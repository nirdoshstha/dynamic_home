<?php

namespace App\Http\Controllers\backend;

use App\Models\General;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Traits\ImageTrait;

class SettingController extends BackendBaseController
{
    private $model;
    protected $panel = 'Setting';
    protected $base_route = 'setting.';
    protected $view_path = 'backend.setting.';
    protected $img_path = 'uploads/setting/';

    public function __construct()
    {
        $this->model = new Setting();
    }

    use ImageTrait;

    public function index()
    {
        $socials_media = General::where('type', 'setting')->orderBy('rank', 'asc')->get();

        $setting = $this->model->first();
        return view($this->__loadDataToView($this->view_path . 'index'), compact('setting', 'socials_media'));
    }

    public function store(SettingRequest $request)
    {

        try {
            $data = $request->all();

            if ($request->hasFile('logo')) {
                $image_name = $this->imageUpload($request->logo, 'setting');
                $data['logo'] = $image_name;
            }
            if ($request->hasFile('fav_icon')) {
                $fab_name = $this->imageUpload($request->fav_icon, 'setting');
                $data['fav_icon'] = $fab_name;
            }
            if ($request->hasFile('brochure_image')) {
                $brochure_image = $this->imageUpload($request->brochure_image, 'setting');
                $data['brochure'] = $brochure_image;
            }
            if ($request->hasFile('brochure')) {
                $brochure = $this->imageUpload($request->brochure, 'setting');
                $data['brochure'] = $brochure;
            }
            if ($request->hasFile('background_image')) {
                $background_image = $this->imageUpload($request->background_image, 'setting');
                $data['background_image'] = $background_image;
            }
            if ($request->hasFile('school_image')) {
                $school_image = $this->imageUpload($request->school_image, 'setting');
                $data['school_image'] = $school_image;
            }
            if ($request->hasFile('college_image')) {
                $college_image = $this->imageUpload($request->college_image, 'setting');
                $data['college_image'] = $college_image;
            }
            if ($request->hasFile('popup_image')) {
                $popup_image = $this->imageUpload($request->popup_image, 'setting');
                $data['popup_image'] = $popup_image;
            }
            if ($request->hasFile('master_logo')) {
                $master_logo = $this->imageUpload($request->master_logo, 'setting');
                $data['master_logo'] = $master_logo;
            }
            // if ($request->hasFile('background_image')) {
            //     $path = 'setting/background_image';
            //     $request['background_image']->storePubliclyAs('uploads', $path, 'public');
            //     $data['background_image'] = 'uploads/' . $path;
            // }
            // if ($request->hasFile('school_image')) {
            //     $path = 'setting/school_image';
            //     $request['school_image']->storePubliclyAs('uploads', $path, 'public');
            //     $data['school_image'] = 'uploads/' . $path;
            // }
            // if ($request->hasFile('college_image')) {
            //     $path = 'setting/college_image';
            //     $request['college_image']->storePubliclyAs('uploads', $path, 'public');
            //     $data['college_image'] = 'uploads/' . $path;
            // }

            $setting = Setting::create($data + [
                'created_by' => auth()->user()->id,
            ]);


            // return redirect()->back()->with('success_message', 'Setting Stored Successfully !!');
            return response()->json([
                'success_message' => 'Setting Stored Successfully !!',
                'url' => route($this->base_route . 'index')
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Something Went Wrong !!');
        }
    }

    public function update(SettingRequest $request)
    {
        $setting = Setting::first();
        try {
            $data = $request->except('logo', 'fav_icon', 'brochure_image', 'brochure', 'background_image', 'school_image', 'college_image', 'popup_image', 'master_logo');

            if ($request->hasFile('logo')) {
                deleteImage($setting->logo);
                $image_name = $this->imageUpload($request->logo, 'setting');
                $data['logo'] = $image_name;
            }
            if ($request->hasFile('fav_icon')) {
                deleteImage($setting->fav_icon);
                $fab_name = $this->imageUpload($request->fav_icon, 'setting');
                $data['fav_icon'] = $fab_name;
            }
            if ($request->hasFile('brochure_image')) {
                deleteImage($setting->brochure_image);
                $brochure_image = $this->imageUpload($request->brochure_image, 'setting');
                $data['brochure_image'] = $brochure_image;
            }
            if ($request->hasFile('brochure')) {
                deleteImage($setting->brochure);
                $brochure = $this->imageUpload($request->brochure, 'setting');
                $data['brochure'] = $brochure;
            }
            if ($request->hasFile('background_image')) {
                deleteImage($setting->background_image);
                $background_image = $this->imageUpload($request->background_image, 'setting');
                $data['background_image'] = $background_image;
            }
            if ($request->hasFile('school_image')) {
                deleteImage($setting->school_image);
                $school_image = $this->imageUpload($request->school_image, 'setting');
                $data['school_image'] = $school_image;
            }
            if ($request->hasFile('college_image')) {
                deleteImage($setting->college_image);
                $college_image = $this->imageUpload($request->college_image, 'setting');
                $data['college_image'] = $college_image;
            }
            if ($request->hasFile('popup_image')) {
                deleteImage($setting->popup_image);
                $popup_image = $this->imageUpload($request->popup_image, 'setting');
                $data['popup_image'] = $popup_image;
            }
            if ($request->hasFile('master_logo')) {
                deleteImage($setting->master_logo);
                $master_logo = $this->imageUpload($request->master_logo, 'setting');
                $data['master_logo'] = $master_logo;
            }
            // if ($request->hasFile('background_image')) {
            //     deleteImage($setting->background_image);
            //     $path = 'setting/background_image.'.$request['background_image']->getClientOriginalExtension();
            //     $request['background_image']->storePubliclyAs('uploads', $path, 'public');
            //     $data['background_image'] = 'uploads/' . $path;
            // }
            // if ($request->hasFile('school_image')) {
            //     deleteImage($setting->school_image);
            //     $path = 'setting/school_image.'.$request['school_image']->getClientOriginalExtension();
            //     $request['school_image']->storePubliclyAs('uploads', $path, 'public');
            //     $data['school_image'] = 'uploads/' . $path;
            // }
            // if ($request->hasFile('college_image')) {
            //     deleteImage($setting->college_image);
            //     $path = 'setting/college_image.'.$request['college_image']->getClientOriginalExtension();
            //     $request['college_image']->storePubliclyAs('uploads', $path, 'public');
            //     $data['college_image'] = 'uploads/' . $path;
            // }
            $setting->update($data + [
                'updated_by' => auth()->user()->id,
            ]);

            $setting->save();
            // return redirect()->back()->with('success_message', 'Setting Updated Successfully !!');
            return response()->json([
                'success_message' => 'Setting Updated Successfully...... !!',
                'url' => route($this->base_route . 'index')
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Something Went Wrong !!');
        }
    }

    public function settingSocialMedia(Request $request)
    {

        try {
            $id = $request['social_id'];
            foreach ((array) $request['name'] as $index => $social) {
                $social = General::updateOrCreate([
                    'id' => $id[$index] ?? null,
                ], [
                    'type' => 'setting',
                    'user_id' => auth()->user()->id,
                    'name'      => $request['name'][$index],
                    'link'     => $request['link'][$index],
                    'icon'     => $request['icon'][$index],
                    'rank'     => $request['rank'][$index],
                    $id ? 'updated_by' : 'created_by' => auth()->user()->id,
                ]);
            }
            // return redirect()->back()->with('success_message','Successfully Stored Data..');
            return response()->json([
                'success_message' => 'Setting Updated Successfully...... !!',
                'url' => route($this->base_route . 'index')
            ]);
        } catch (\Exception $e) {
            // return redirect()->back()->with('error_message','Something Went Wrong..');
            return response()->json([
                'error_message' => 'Something went wrong...... !!',
                'url' => route($this->base_route . 'index')
            ]);
        }
    }

    public function settingSocialMediaDestroy(Request $request)
    {

        $id = $request['id'];
        $socials_media = General::find($id);
        $socials_media->delete();
        return response()->json([
            'sucess_message' => 'Social Media Deleted Successfully',
            'url' => route('setting.index'),
        ]);
        // return redirect()->back()->with('success_message', 'Setting Deleted Successfully !!');
    }

    public function destroyPopupImage(Request $request)
    {

        $setting = Setting::first();

        try {
            if ($setting) {
                deleteImage($setting->popup_image);
                $setting->popup_image = null;
                $setting->save();
                return redirect()->back()->with('success_message', 'Pop Image is deleted !!');
            }
        } catch (\Exception $e) {
            return redirect()->back('error_message', 'Something Went wrong !!');
        }
    }

    public function destroyLogoImage(Request $request)
    {

        $setting = Setting::first();

        try {
            if ($setting) {
                deleteImage($setting->logo);
                $setting->logo = null;
                $setting->save();
                return redirect()->back()->with('success_message', 'Logo Image is deleted !!');
            }
        } catch (\Exception $e) {
            return redirect()->back('error_message', 'Something Went wrong !!');
        }
    }

    public function destroyMasterLogo(Request $request)
    {

        $setting = Setting::first();

        try {
            if ($setting) {
                deleteImage($setting->master_logo);
                $setting->master_logo = null;
                $setting->save();
                return redirect()->back()->with('success_message', 'Master Logo is deleted !!');
            }
        } catch (\Exception $e) {
            return redirect()->back('error_message', 'Something Went wrong !!');
        }
    }

    public function settingGoogleMapStatus(Request $request)
    {

        try {
            $status = $this->model->find($request['id']);
            $status->show_hide_google_map = $status->show_hide_google_map ? '0' : '1';
            $status->save();
            return response()->json([
                'success_message' => $this->panel . ' Status of google map show hide changed successfully !!',
                'url' => route($this->base_route . 'index'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong..',
            ]);
        }
    }
}
