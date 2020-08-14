<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Category;
use App\Http\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Classes\ThumbMaker as Thumb;
use File;
use DB;

class ServiceController extends Controller
{
    public function index()
    {
        // $services = Service::orderBy('id', 'DESC')->where('lang_parent', null)->paginate(10);
        $services = DB::table('services')->join('categories', 'categories.id', '=', 'services.category_id')
        ->select('services.*', 'categories.name as category_name')->where('services.lang_parent', null)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories_name = Category::categories_name();
        return view('admin.services.add', ['categories' => $categories_name]);
    }

    public function store(Request $request)
    {
        $categories_name = Category::categories_name();
        $categories_id = implode(',', array_keys($categories_name));
        $user_id = auth()->id();
        $rules = [
            'name' => 'required|max:150',
            'description' => 'required|max:10000',
            'name1' => 'required|max:150',
            'description1' => 'required|max:10000',
            'image_path' => 'required|image|max:3000',
            'path_all_image.*' => 'image|max:3000',
            'category_id' => 'required|integer|in:'.$categories_id
        ];
        $this->validate(request(), $rules);
        $service = Service::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);
        $service1 = Service::create([
            'user_id' => $user_id,
            'name' => $request->name1,
            'description' => $request->description1,
            'category_id' => $request->category_id,
            'lang_parent' => $service->id,
            'lang_code' => 'ar'
        ]);
        $imgpath = 'photos/services_images';
        $dir = 'public/' . $imgpath . '/' . $service->id;
        if (is_dir($dir) === false ) {
            File::makeDirectory($dir, 0777);
        }
        if (is_dir($dir . '/gallery') === false) {
            File::makeDirectory($dir . '/gallery', 0777);
        }
        /*******************************************/
        // image path
        $thumb1 = new Thumb();
        // image path
        $imgpath1 = $thumb1->saveImage($request->image_path, $imgpath, $service->id, 'service_image');
         // making thumbnail1   450
        $imgpath2 = $thumb1->aspect4Width($request->image_path, 450,236, $imgpath, $service->id, 'service_image_thumbnail_1');
        // making thumbnail2  h 100
        $imgpath3 = $thumb1->aspect4Height($request->image_path, 191,100, $imgpath, $service->id, 'service_image_thumbnail_2');
        /******************/
        // save gallery 
        $gallery_paths = null;
        if ($request->hasFile('path_all_image')) {
            if (count($request->path_all_image > 0)) {
                $all_paths = [];
                $i = 1;
                foreach ($request->path_all_image as $img) {
                    $all_paths[] = $thumb1->save($img, $imgpath . '/' . $service->id . '/gallery', 'service_image_gallery_' . $i);
                    $i++;
                }
                $gallery_paths = implode(',', $all_paths);
            }
        }
        /******************/
        // inserting images path.
        $service->update([
            'image_path' => $imgpath1,
            'image_path_thumbnail_1' => $imgpath2,
            'image_path_thumbnail_2' => $imgpath3,
            'path_all_image' => $gallery_paths
        ]);
        $service1->update([
            'image_path' => $imgpath1,
            'image_path_thumbnail_1' => $imgpath2,
            'image_path_thumbnail_2' => $imgpath3,
            'path_all_image' => $gallery_paths
        ]);
        /*************************/
        return redirect()->route('services.create')->with('success', 'Service has been created successfully');
    }

    public function edit(Service $service)
    {
        $categories_name = Category::categories_name();
        $service_en = $service;
        $service_ar = Service::where('lang_parent', $service->id)->where('lang_code', 'ar')->first();
        if ($service_en != null && $service_ar != null) {
            return view('admin.services.edit', ['categories' => $categories_name, 'service_en' => $service_en, 'service_ar' => $service_ar]);
        } else {
            return back();
        }
    }

    public function update(Request $request, Service $service)
    {
        $categories_name = Category::categories_name();
        $categories_id = implode(',', array_keys($categories_name));
        $rules = [
            'name' => 'required|max:150',
            'description' => 'required|max:10000',
            'name1' => 'required|max:150',
            'description1' => 'required|max:10000',
            'image_path' => 'image|max:3000',
            'path_all_image.*' => 'image|max:3000',
            'category_id' => 'required|integer|in:'.$categories_id
        ];
        $this->validate(request(), $rules);
        $service1 = Service::where('lang_parent', $service->id)->where('lang_code', 'ar')->first();
        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);
        $service1->update([
            'name' => $request->name1,
            'description' => $request->description1,
            'category_id' => $request->category_id
        ]);

        $imgpath = 'photos/services_images';
        $dir = 'public/' . $imgpath . '/' . $service->id;
        $thumb1 = new Thumb();
        if ($request->hasFile('image_path')) {
            if (is_dir($dir) === false ) {
                File::makeDirectory($dir, 0777);
            }
            // delete old main image
            if (file_exists('public/' . $service->image_path)) {
                unlink('public/' . $service->image_path);
            }
            if (file_exists('public/' . $service->image_path_thumbnail_1)) {
                unlink('public/' . $service->image_path_thumbnail_1);
            }
            if (file_exists('public/' . $service->image_path_thumbnail_2)) {
                unlink('public/' . $service->image_path_thumbnail_2);
            }
            // image path
            $imgpath1 = $thumb1->saveImage($request->image_path, $imgpath, $service->id, 'service_image');
            // making thumbnail1   450
            $imgpath2 = $thumb1->aspect4Width($request->image_path, 450,236, $imgpath, $service->id, 'service_image_thumbnail_1');
            // making thumbnail2  h 100
            $imgpath3 = $thumb1->aspect4Height($request->image_path, 191,100, $imgpath, $service->id, 'service_image_thumbnail_2');
            
            // inserting images path.
            $service->update([
                'image_path' => $imgpath1,
                'image_path_thumbnail_1' => $imgpath2,
                'image_path_thumbnail_2' => $imgpath3
            ]);
            $service1->update([
                'image_path' => $imgpath1,
                'image_path_thumbnail_1' => $imgpath2,
                'image_path_thumbnail_2' => $imgpath3
            ]);
            /*************************/
        }
        // save gallery 
        /*************************/
        if ($request->hasFile('path_all_image')) {
            if (is_dir($dir . '/gallery') === false) {
                File::makeDirectory($dir . '/gallery', 0777);
            }
            $old_images = explode(',', $service->path_all_image);
            $all_paths = [];
            $all_images_updated = [];
            $i = 1;
            foreach ($request->path_all_image as $key => $img) {
                if (in_array($key, $old_images) && !is_numeric($key)) {
                    $index = array_search($key, $old_images);
                    array_splice($old_images, $index, 1);
                    $all_images_updated[] = $key;
                }
            }
            foreach ($all_images_updated as $path) {
                if (file_exists('public/' . $path)) {
                    unlink('public/' . $path);
                }
            }
            foreach ($request->path_all_image as $key => $img) {
                if (!is_numeric($key)) {
                    $search_index_file = preg_match("/service_image_gallery_([0-9]+)_/", $key, $matches);
                    $index_file = $matches[1];
                } else {
                    $index_file = $i;
                }
                $all_paths[] = $thumb1->save($img, $imgpath . '/' . $service->id . '/gallery', 'service_image_gallery_' . $index_file);
                $i++;
            }
            $gallery_paths = implode(',', array_merge($old_images, $all_paths));
            /******************/
            // inserting images path.
            $service->update([
                'path_all_image' => $gallery_paths
            ]);
            $service1->update([
                'path_all_image' => $gallery_paths
            ]);
        }
        /*******************************************/
        return redirect()->route('services.index')->with('success', 'Service has been updated successfully');
    }
    
    public function destroy($id)
    {
        $imgpath = 'photos/services_images';
        $dir = 'public/' . $imgpath . '/' . $id;
        if (is_dir($dir) != false) {
            File::deleteDirectory($dir);
        }
        Service::where('lang_parent', $id)->where('lang_code', 'ar')->delete();
        Service::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'Category has been deleted successfully'
        ]);
    }
}
