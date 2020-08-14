<?php
namespace App\Classes;
use Image;
class ThumbMaker
{
    private function getExtension($mime)
    {
        if ($mime == 'image/jpeg') {
            $extension = '.jpg';
        } elseif  ($mime == 'image/png') {
            $extension = '.png';
        } elseif ($mime == 'image/gif') {
            $extension = '.gif';
        }
        return $extension;
    }

    // save image in any path
    public function save($image, $img_path, $filname) {
        $img = Image::make($image);
        $mime = $img->mime();
        $extension = $this->getExtension($mime);
        $img_path_db = $img_path . '/' . $filname . '_' . time() . $extension;
        $img_path_save = 'public/' . $img_path_db;
        $img->save($img_path_save);
        return $img_path_db;
    }

    // save image in direction id post
    public function saveImage($image, $img_path, $post_id, $filname) {
        $img = Image::make($image);
        $mime = $img->mime();
        $extension = $this->getExtension($mime);
        $img_path_db = $img_path . '/' . $post_id . '/' . $filname . '_' . time() . $extension;
        $img_path_save = 'public/' . $img_path_db;
        $img->save($img_path_save);
        return $img_path_db;
    }

    public function aspect4Width($image, $width, $heigh, $img_path, $post_id, $filname) 
    {
        $img = Image::make($image);
        $mime = $img->mime();
        $extension = $this->getExtension($mime);
        $img_path_db = $img_path.'/'.$post_id.'/'.$filname.'_'.time().$extension;
        $img_path_save = 'public/'.$img_path_db;

        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        if($img->height() < $heigh){
            $img->resize(null, $heigh);
        } else if($img->height() > $heigh){
            $img->crop($width, $heigh, 0, 0);
        }
        $img->save($img_path_save);
        return $img_path_db;
    }

    public function aspect4Height($image, $width, $heigh, $img_path, $post_id, $filname)
    {
        $img = Image::make($image);
        $mime = $img->mime();
        $extension = $this->getExtension($mime);
        $img_path_db = $img_path.'/'.$post_id.'/'.$filname.'_'.time().$extension;
        $img_path_save = 'public/'.$img_path_db;

        $img->resize(null, $heigh, function ($constraint) {
            $constraint->aspectRatio();
        });
        if($img->width() < $width){
            $img->resize($width, null);
        }
        else if($img->width() > $width){
            $img->crop($width, $heigh, 0, 0);
        }
        $img->save($img_path_save);
        return $img_path_db;
    }

}