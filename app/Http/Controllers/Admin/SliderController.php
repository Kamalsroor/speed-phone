<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Slider;
use App\Classes\ThumbMaker as Thumb;
use File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id', 'DESC')->paginate(10);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.add');
    }

    public function store(Request $request)
    {
        $user_id = auth()->id();
        $rules = [
            'name' => 'required|max:100',
            'display' => 'required|in:0,1',
            'image_path' => 'required|image|max:3000',
        ];
        $this->validate(request(), $rules);
        $slider = Slider::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'display' => $request->display,
        ]);
        $imgpath = 'photos/slider_images';
        $dir = 'public/' . $imgpath . '/' . $slider->id;
        if (is_dir($dir) === false ) {
            File::makeDirectory($dir, 0777);
        }
        /*******************************************/
        // image path
        $thumb1 = new Thumb();
        // image path
        $imgpath1 = $thumb1->saveImage($request->image_path, $imgpath, $slider->id, 'slider_image');
         // making thumbnail1   450
        $imgpath2 = $thumb1->aspect4Width($request->image_path, 450,236, $imgpath, $slider->id, 'slider_image_thumbnail_1');
        // making thumbnail2  h 100
        $imgpath3 = $thumb1->aspect4Height($request->image_path, 191,100, $imgpath, $slider->id, 'slider_image_thumbnail_2');
        /******************/
        // inserting images path.
        $slider->update([
            'image_path' => $imgpath1,
            'image_path_thumbnail_1' => $imgpath2,
            'image_path_thumbnail_2' => $imgpath3,
        ]);
        /*************************/
        return redirect()->route('slider.create')->with('success', 'Slider has been created successfully');
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        if ($slider != null) {
            return view('admin.slider.edit', compact('slider'));
        } else {
            return back();
        }
    }

    public function update(Request $request, Slider $slider)
    {
        $rules = [
            'name' => 'required|max:100',
            'display' => 'required|in:0,1',
            'image_path' => 'image|max:3000',
        ];
        $this->validate(request(), $rules);
        $slider->update([
            'name' => $request->name,
            'display' => $request->display,
        ]);
        $imgpath = 'photos/slider_images';
        $dir = 'public/' . $imgpath . '/' . $slider->id;
        if ($request->hasFile('image_path')) {
            if (is_dir($dir) === false ) {
                File::makeDirectory($dir, 0777);
            } else {
                File::deleteDirectory($dir);
                File::makeDirectory($dir, 0777);
            }
            /*******************************************/
            // image path
            $thumb1 = new Thumb();
            // image path
            $imgpath1 = $thumb1->saveImage($request->image_path, $imgpath, $slider->id, 'slider_image');
            // making thumbnail1   450
            $imgpath2 = $thumb1->aspect4Width($request->image_path, 450,236, $imgpath, $slider->id, 'slider_image_thumbnail_1');
            // making thumbnail2  h 100
            $imgpath3 = $thumb1->aspect4Height($request->image_path, 191,100, $imgpath, $slider->id, 'slider_image_thumbnail_2');
            /******************/
            // inserting images path.
            $slider->update([
                'image_path' => $imgpath1,
                'image_path_thumbnail_1' => $imgpath2,
                'image_path_thumbnail_2' => $imgpath3,
            ]);
        }
        /*************************/
        return redirect()->route('slider.index')->with('success', 'Slider has been updated successfully');
    }

    public function destroy(Slider $slider)
    {
        $imgpath = 'photos/slider_images';
        $dir = 'public/' . $imgpath . '/' . $slider->id;
        if (is_dir($dir) != false ) {
            File::deleteDirectory($dir);
        }
        $slider->delete();
        return response()->json([
            'status' => true,
            'message' => 'Slider has been deleted successfully'
        ]);
    }
}
