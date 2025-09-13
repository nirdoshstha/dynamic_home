<?php

namespace App\Traits;

use App\Models\Imageable;

trait ImageTrait{

    public function imageUpload($image,$dir)
    {
        $path = $dir.'/'.date('yms').$image->hashName();
        $image->storePubliclyAs('uploads',$path,'public');
        return 'uploads/'.$path;
    }

    // upload multiple image 7th step
    public function uploadMultiple(string $dir = null, $image)
    {
            $imageable = new Imageable();
            //upload image
            $dir = $dir ? $dir : 'others';
            $path = $dir.'/'.date('yms').time().'.jpg';

            $image->storePubliclyAs('uploads',$path,'public');
            $imageable->url ='uploads/'.$path;
            $imageable->save();

            return ['image_id'=>$imageable->id,'path'=>$path];

        // return $path;

    }

    // upload multiple image 8th step
    public function storeMultipleImage($gallery,$other_image)
    {
        if($other_image){
            $images = Imageable::find($other_image);
            foreach($images as $image){
             $image->update([
                 'imageable_id'=>$gallery->id,
                 'imageable_type'=>get_class($gallery)
             ]);
            }
        }

    }
}
