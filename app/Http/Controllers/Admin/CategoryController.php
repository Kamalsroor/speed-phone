<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Category;
use Illuminate\Http\Request;
use App\Classes\ThumbMaker as Thumb;
use File;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->where('lang_parent', null)->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $parents_id = Category::parents_id();
        return view('admin.category.add', ['parents_id' => $parents_id]);
    }

    public function store(Request $request)
    {
        $user_id = auth()->id();
        $rules = [
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
            'name1' => 'required|max:100',
            'description1' => 'required|max:1000',
            'image_path' => 'required|image|max:3000',
        ];
        $this->validate(request(), $rules);
        $category = Category::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);
        $parentAr = null;
        if($request->parent_id != null) {
            $parentAr = Category::where('lang_parent', $request->parent_id)->where('lang_code', 'ar')->first();
            $parentAr = $parentAr->id;
        }
        $category1 = Category::create([
            'user_id' => $user_id,
            'name' => $request->name1,
            'description' => $request->description1,
            'parent_id' => $parentAr,
            'lang_code' => 'ar',
            'lang_parent' => $category->id,
        ]);
        $imgpath = 'photos/categories_images';
        $dir = 'public/' . $imgpath . '/' . $category->id;
        if (is_dir($dir) === false ) {
            File::makeDirectory($dir, 0777);
        }
        /*******************************************/
        // image path
        $thumb1 = new Thumb();
        // image path
        $imgpath1 = $thumb1->saveImage($request->image_path, $imgpath,$category->id, 'category_image');
         // making thumbnail1   450
        $imgpath2 = $thumb1->aspect4Width($request->image_path, 450,236, $imgpath, $category->id, 'category_image_thumbnail_1');
        // making thumbnail2  h 100
        $imgpath3 = $thumb1->aspect4Height($request->image_path, 191,100, $imgpath, $category->id, 'category_image_thumbnail_2');
        /******************/
        // inserting images path.
        $category->update([
            'image_path' => $imgpath1,
            'image_path_thumbnail_1' => $imgpath2,
            'image_path_thumbnail_2' => $imgpath3,
        ]);
        $category1->update([
            'image_path' => $imgpath1,
            'image_path_thumbnail_1' => $imgpath2,
            'image_path_thumbnail_2' => $imgpath3,
        ]);
        /*************************/
        return redirect()->route('categories.create')->with('success', 'Category has been created successfully');
    }

    
    public function edit(Category $category)
    {
        $parents_id = Category::parents_id();
        $category_en = $category;
        $category_ar = Category::where('lang_parent', $category->id)->where('lang_code', 'ar')->first();
        if ($category_en != null && $category_ar != null) {
            return view('admin.category.edit', ['parents_id' => $parents_id, 'category_en' => $category_en, 'category_ar' => $category_ar]);
        } else {
            return back();
        }
    }

   
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
            'name1' => 'required|max:100',
            'description1' => 'required|max:1000',
            'image_path' => 'image|max:3000',
        ];
        $this->validate(request(), $rules);
        $category1 = Category::where('lang_parent', $category->id)->where('lang_code', 'ar')->first();
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);
        $parentAr = null;
        if($request->parent_id != null) {
            $parentAr = Category::where('lang_parent', $request->parent_id)->where('lang_code', 'ar')->first();
            $parentAr = $parentAr->id;
        }
        $category1->update([
            'name' => $request->name1,
            'description' => $request->description1,
            'parent_id' => $parentAr
        ]);
        $imgpath = 'photos/categories_images';
        $dir = 'public/' . $imgpath . '/' . $category->id;
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
            $imgpath1 = $thumb1->saveImage($request->image_path, $imgpath,$category->id, 'category_image');
            // making thumbnail1   450
            $imgpath2 = $thumb1->aspect4Width($request->image_path, 450,236, $imgpath, $category->id, 'category_image_thumbnail_1');
            // making thumbnail2  h 100
            $imgpath3 = $thumb1->aspect4Height($request->image_path, 191,100, $imgpath, $category->id, 'category_image_thumbnail_2');
            /******************/
            // inserting images path.
            $category->update([
                'image_path' => $imgpath1,
                'image_path_thumbnail_1' => $imgpath2,
                'image_path_thumbnail_2' => $imgpath3,
            ]);
            $category1->update([
                'image_path' => $imgpath1,
                'image_path_thumbnail_1' => $imgpath2,
                'image_path_thumbnail_2' => $imgpath3,
            ]);
        }
        /*************************/
        return redirect()->route('categories.index')->with('success', 'Category has been updated successfully');
    }

    public function destroy(Category $category)
    {
        $dir = 'public/photos/categories_images/';
        $category1 = Category::where('lang_parent', $category->id)->where('lang_code', 'ar')->first();
        $childs_categories = Category::where('parent_id', $category->id)->get(); 
        $childs_categories_1 = Category::where('parent_id', $category1->id)->get();

        // Delete Direction images [ categories_images ]
        // delete image category post 
        if (is_dir($dir . $category->id) != false) {
            File::deleteDirectory($dir . $category->id);
        }

        // delete image sub categories
        foreach ($childs_categories as $cate) {
            if (is_dir($dir . $cate->id) != false) {
                File::deleteDirectory($dir . $cate->id);
            }
        }
        /******************************/
        // Delete Categories from database
        $category->delete();
        $category1->delete();
        // Delete sub categories
        if (count($childs_categories) > 0) {
            $ids = [];
            foreach ($childs_categories as $cate) {
                $ids[] = $cate->id;
            }
            Category::destroy($ids);
        }
        if (count($childs_categories_1) > 0) {
            $ids1 = [];
            foreach ($childs_categories_1 as $cate) {
                $ids1[] = $cate->id;
            }
            Category::destroy($ids1);
        }
        return response()->json([
            'status' => true,
            'message' => 'Category has been deleted successfully'
        ]);
    }
}
