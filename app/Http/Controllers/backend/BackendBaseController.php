<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendBaseController extends Controller
{
    //function to load data to view file
    protected function __loadDataToView($viewPath){
        view()->composer($viewPath,function($view){
            $view->with('panel',$this->panel);
            $view->with('view_path',$this->view_path);
            $view->with('base_route',$this->base_route);
            if(isset($this->img_path)){
                $view->with('img_path',$this->img_path);
            }
        });
        return $viewPath;
    }

     //Dynamic Image
    protected function uploadImage($image){
        $image_name = time().'_'.$image->getClientOriginalName();
        $images =$image->move($this->img_path, $image_name);
        // $image->logo = $images;
        // return $image->logo;
        $image->image = $images;
        return $image->image;
    }


    protected function deleteImage($image_name){
        $image =$image_name;
        if(is_file( $image)){
            unlink($image);
        }
    }
}
