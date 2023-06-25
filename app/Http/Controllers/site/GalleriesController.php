<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Media;
use DB;

use Response;


class GalleriesController extends BaseSiteController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($type)
    {
        if($type == 'videos'){
            $albums =  Gallery::where('type','=',$type)->with('videos')->orderBy('created_at', 'DESC')->paginate(4);
            return view('site.galleries.videos', compact('albums'));
        }

        $galleries = Gallery::where('type','=',$type)->with('photos')->orderBy('created_at', 'DESC')->paginate(4);
        return view('site.galleries.index', compact('galleries'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function videos($slug)
    {
        $album = Gallery::findBySlug($slug);

        //if  content not found
		if(!$album) return view('site.default-not-found');

        $videos = Video::where('gallery_id','=',$album->id)->orderBy('created_at', 'DESC')->paginate(16);

        return view('site.galleries.video_gallery', compact('album','videos'));
    }

    public function photos($slug)
    {
        $gallery = Gallery::findBySlug($slug);

        //if  content not found
		if(!$gallery) return view('site.default-not-found');

        $photos = Photo::where('gallery_id','=',$gallery->id)->orderBy('created_at', 'DESC')->paginate(16);

        return view('site.galleries.photo_gallery', compact('gallery','photos'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function video($slug)
    {
        $video = Photo::findBySlug($slug);

        //if  content not found
		if(!$video) return view('site.default-not-found');

        return view('site.galleries.show_video', compact('video'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($galleryID)
    {
        $gallery = Photo::where('gallery_id','=',$galleryID)->get();

        //if  content not found
		if(!$gallery) return view('site.default-not-found');

        return view('site.galleries.show', compact('gallery'));
    }

    public function showSlider($id)
    {
        //$slider = Photo::findBySlug($id);
        $slider = Photo::find($id);
        return view('site.galleries.show-slider', compact('slider'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function videos_old()
    {

       $galleries = Gallery::where('type','=','videos')->with('videos')->paginate(20);

       $videos = DB::table('galleries')
        ->join('media','gallery_id','=','galleries.id')
        ->where('galleries.type','=','videos')->select('media.*')->paginate(15);

        return view('site.galleries.videos', compact('videos'));
    }



}
