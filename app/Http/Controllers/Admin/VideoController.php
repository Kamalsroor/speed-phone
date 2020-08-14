<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Video;
use Illuminate\Http\Request;
use App\Classes\ThumbMaker as Thumb;
use File;

class VideoController extends Controller
{

    private $pattern_video = "/\?v=([\w-]+)(\&t=(\d+))?/";
    public function index()
    {
        $videos = Video::orderBy('id', 'DESC')->where('lang_parent', null)->paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.add');
    }

    public function store(Request $request)
    {
        $user_id = auth()->id();
        $pattern_get_id_video_from_youtube = $this->pattern_video;
        $rules = [
            'name' => 'required|max:150',
            'description' => 'required|max:10000',
            'name1' => 'required|max:150',
            'description1' => 'required|max:10000',
            'video_path' => 'required|regex:' . $pattern_get_id_video_from_youtube . '|max:150',
        ];
        $this->validate(request(), $rules);
        preg_match($pattern_get_id_video_from_youtube, $request->video_path, $matches);
        $id_video = $matches[1];
        $video = Video::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'description' => $request->description,
            'video_path' => $request->video_path,
            'video_id_youtube' => $id_video,
        ]);
        $video1 = Video::create([
            'user_id' => $user_id,
            'name' => $request->name1,
            'description' => $request->description1,
            'video_path' => $request->video_path,
            'video_id_youtube' => $id_video,
            'lang_parent' => $video->id,
            'lang_code' => 'ar'
        ]);
        return redirect()->route('videos.create')->with('success', 'Video has been created successfully');
    }

    public function edit($id)
    {
        $video = Video::find($id);
        if ($video != null) {
            $pattern_get_id_video_from_youtube = $this->pattern_video;
            preg_match($pattern_get_id_video_from_youtube, $video->video_path, $matches);
            $start_video = count($matches) > 3 ? '?start=' . $matches[3] : '';
            $video_ar = Video::where('lang_parent', $video->id)->where('lang_code', 'ar')->first();
            return view('admin.videos.edit', ['video_en' => $video, 'video_ar' => $video_ar, 'start_video' => $start_video]);
        } else {
            return back();
        }
    }
    
    public function update(Request $request, Video $video)
    {
        $pattern_get_id_video_from_youtube = $this->pattern_video;
        $rules = [
            'name' => 'required|max:150',
            'description' => 'required|max:10000',
            'name1' => 'required|max:150',
            'description1' => 'required|max:10000',
            'video_path' => 'required|regex:' . $pattern_get_id_video_from_youtube . '|max:150',
        ];
        $this->validate(request(), $rules);
        preg_match($pattern_get_id_video_from_youtube, $request->video_path, $matches);
        $id_video = $matches[1];
        $video1 = Video::where('lang_parent', $video->id)->where('lang_code', 'ar')->first();
        $video->update([
            'name' => $request->name,
            'description' => $request->description,
            'video_path' => $request->video_path,
            'video_id_youtube' => $id_video,
        ]);
        $video1->update([
            'name' => $request->name1,
            'description' => $request->description1,
            'video_path' => $request->video_path,
            'video_id_youtube' => $id_video
        ]);
        return redirect()->route('videos.index')->with('success', 'Video has been updated successfully');
    }
    
    public function destroy($id)
    {
        Video::where('lang_parent', $id)->where('lang_code', 'ar')->delete();
        Video::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'Video has been deleted successfully'
        ]);
    }
}
