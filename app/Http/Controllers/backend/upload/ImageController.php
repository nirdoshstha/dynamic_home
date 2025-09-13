<?php

namespace App\Http\Controllers\backend\upload;

use App\Http\Controllers\Controller;
use App\Models\Imageable;
use App\Toastr\Toastr;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    use ImageTrait;

    public function upload(Request $request)
    {

        $path = $this->uploadMultiple(null, $request->file('files'));


        return response()->json(['success' => true, 'file' => $path['path'], 'image_id' => $path['image_id']]);
    }

    public function delete($id)
    {
        $image = Imageable::find($id);
        deleteImage($image->url);
        $image->delete();
        // Toastr::success('Successfully Deleted!!');
        return redirect()->back()->with('success_message', 'Images Deleted Successfully');
        // return redirect()->back();
    }

    public function imageableStatus(Request $request)
    {
        try {
            $imageable = Imageable::find($request['id']);
            $imageable->status = $imageable->status ? '0' : '1';
            $imageable->save();
            return response()->json([
                'success_message' => ' Status Changed Successfully !!',

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error_message' => 'Something Went Wrong..',
            ]);
        }
    }
}
