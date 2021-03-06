<?php

namespace Proto\Http\Controllers;

use Illuminate\Http\Request;
use Proto\Models\Event;
use Proto\Models\Video;

use Session;
use Redirect;
use Youtube;
use DateInterval;

class VideoController extends Controller
{
    static public function index()
    {
        return view('videos.index', ['videos' => Video::all()]);
    }

    static public function publicIndex()
    {
        return view('videos.public_index', ['videos' => Video::orderBy('video_date', 'desc')->get()]);
    }

    static public function view(Request $request)
    {
        return view('videos.view', ['video' => Video::findOrFail($request->id)]);
    }

    static public function store(Request $request)
    {
        $youtube_id = $request->youtube_id;

        $youtube_video = Youtube::getVideoInfo($youtube_id);

        if (!$youtube_video) {
            Session::flash("flash_message", "This is an invalid YouTube video ID!");
            return Redirect::back();
        }

        if (!$youtube_video->status->embeddable) {
            Session::flash("flash_message", "This video is not embeddable and therefore cannot be used on the site!");
            return Redirect::back();
        }

        if (Video::where('youtube_id', $youtube_video->id)->count() > 0) {
            Session::flash("flash_message", "This video has already been added!");
            return Redirect::back();
        }

        $video = Video::create([
            'title' => $youtube_video->snippet->title,
            'youtube_id' => $youtube_video->id,
            'youtube_title' => $youtube_video->snippet->title,
            'youtube_length' => $youtube_video->contentDetails->duration,
            'youtube_user_id' => $youtube_video->snippet->channelId,
            'youtube_user_name' => $youtube_video->snippet->channelTitle,
            'youtube_thumb_url' => $youtube_video->snippet->thumbnails->high->url,
            'video_date' => date('Y-m-d', strtotime($youtube_video->snippet->publishedAt))
        ])->save();

        Session::flash("flash_message", sprintf("The video %s has been added!", $youtube_video->snippet->title));
        return Redirect::back();

    }

    static public function edit(Request $request)
    {
        $video = Video::findOrFail($request->id);
        return view('videos.edit', ['video' => $video]);
    }

    static public function update(Request $request)
    {
        $video = Video::findOrFail($request->id);

        $video->video_date = date('Y-m-d', strtotime($request->video_date));
        $video->save();

        if ($request->has('event')) {
            $event = Event::findOrFail($request->get('event'));
            $video->event_id = $event->id;
            $video->save();
        }

        Session::flash("flash_message", sprintf("The video %s has been updated!", $video->title));
        return Redirect::route("video::admin::index");
    }

    static public function destroy(Request $request)
    {
        $video = Video::findOrFail($request->id);
        Session::flash("flash_message", sprintf("The video <strong>%s</strong> has been deleted!", $video->title));
        $video->delete();
        return Redirect::back();
    }
}
