<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Gallery;
use App\Models\Photo;
use App\Models\SpecialPage;


class GalleriesController extends BaseController {

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Gallery::get()->groupBy('type');
        $galleries = Gallery::pluck('title_en', 'id');
        $specials = SpecialPage::pluck('title_en', 'id');
        return view('cms.galleries.index', compact('types','galleries','specials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Gallery::$rules);
        $data = $request->all();

        //only one featured photo or video gallery
        if($request->featured == 1){
            Gallery::where('type','=',$request->type)->update(['featured'=>0]);
        }

        $gallery = Gallery::create($data);

        if($gallery){
          return back()->with('status', 'success');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::find($id);

        return view("cms.galleries.edit", compact('gallery'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate(Gallery::$rules);

        $data = $request->all();

        //only one featured photo or video gallery
        if($request->featured == 1){
            Gallery::where('type','=',$request->type)->update(['featured'=>0]);
        }

        $gallery = Gallery::find($id);

        $gallery->update($data);

        return back()->with('status', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Gallery::find($id);
        $medias = Photo::where('gallery_id','=',$id)->get();
         foreach($medias as $media){
           if(file_exists(public_path().'/uploads/gallery/'.$media->filename) && is_file(public_path().'/uploads/gallery/'.$media->filename)){
                unlink(public_path().'/uploads/gallery/'.$media->filename);
            }
        }
        $category->medias()->delete();
        $category->delete();
        //end after

        return back()->with('status', 'success');
    }

}
