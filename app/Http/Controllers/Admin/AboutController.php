<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\About;
use App\Classes\ThumbMaker as Thumb;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::orderBy('id', 'DESC')->where('lang_parent', null)->get();
        return view('admin.about.index', compact('abouts'));
    }

    public function edit($id)
    {
        $about_en = About::find($id);
        $about_ar = About::where('lang_parent', $id)->where('lang_code', 'ar')->first();
        if ($about_en != null && $about_ar != null) {
            return view('admin.about.edit', compact('about_en', 'about_ar'));
        } else {
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $user_id = auth()->id();
        $this->validate(request(), [
            'summary' => 'required|max:500',
            'description' => 'required|max:15000',
            'summary1' => 'required|max:500',
            'description1' => 'required|max:15000',
            'image_path' => 'image|max:3000',
        ]);

        //saving English data in the table.
        $about = About::find($id);
        $about->update([
            'summary' => $request->summary,
            'description' => $request->description,
            'user_id' => $user_id,
        ]);

         //saving Arabic data in the table.
        $about1 = About::where('lang_parent', $id)->where('lang_code', 'ar')->first();
        $about1->update([
            'summary' => $request->summary1,
            'description' => $request->description1,
            'user_id' => $user_id,
        ]);

        $dir = 'public/photos/about_images/' . $about->id;
        if ($request->image_path != null) {
            if (is_dir($dir) === false) {
                \File::makeDirectory($dir, 0777);
            } else {
                \File::deleteDirectory($dir);
                \File::makeDirectory($dir, 0777);
            }
            /*******************************************/
            //  image path
            $thumb1 = new Thumb();
            $imgpath = 'photos/about_images';
            // image path
            $imgpath1 = $thumb1->saveImage($request->image_path,$imgpath,$about->id,'about_image');
            //making thumbnail1   450
            $imgpath2 = $thumb1->aspect4Width($request->image_path,450,236,$imgpath,$about->id,'about_image_thumbnail_1');
            //making thumbnail2  h 100
            $imgpath3 = $thumb1->aspect4Height($request->image_path,191,100,$imgpath,$about->id,'about_image_thumbnail_2');
            /******************/
            // inserting images path.
            $about->update([
                'image_path'=>$imgpath1,
                'image_path_thumbnail_1'=>$imgpath2,
                'image_path_thumbnail_2'=>$imgpath3,
            ]);
            $about1->update([
                'image_path'=>$imgpath1,
                'image_path_thumbnail_1'=>$imgpath2,
                'image_path_thumbnail_2'=>$imgpath3,
            ]);
            /*************************/
        }
        return redirect()->route('about.index')->with('success', 'About has been updated successfully');
    }
}
