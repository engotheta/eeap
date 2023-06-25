<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Gallery;
use Validator;
use Redirect;

class PhotosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($galleryID)
    {
        $gallery = Gallery::findOrFail($galleryID);
        $media = new Media();
        $media->gallery_id = $gallery->id;
        return view('media.index',compact('media','gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $biography = new Biography();
        $biography = Biography::all()->first();
        $biography = ($biography)?$biography:new Biography;
        return view('biographies.create',compact('biography'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($data = $request->all(), Biography::$rules);

        if ($validator->fails())
        {

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $biography = Biography::all()->first();
        $biography = ($biography)?$biography:new Biography;
        $biography->fill($data);
        $biography->save();

        return Redirect::route('cms.biography.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {

        $biographies = Biography::findBySlug($slug);
        return view('biographies.show',compact('biographies')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    public function photoUpload(Request $request){

        $validator = Validator::make($data = $request->all(), ['photourl'=>Biography::$rules['photourl']]);

        if ($validator->fails())
        {

            return Redirect::back()->withErrors($validator)->withInput();
        }




        $biography =  Biography::all()->first();
        if( $biography && $request->hasFile('photourl') ){

            //deleting if there is file
            if(file_exists(public_path().$biography->photourl) && is_file(public_path().$biography->photourl)){
                unlink(public_path().$biography->photourl);
            }

            $imgUrl =$request->file('photourl');
            $filename = 'bio_'.time() . '-' .$imgUrl->getClientOriginalName();
            $imgUrl->move(public_path().'/uploads/bio/', $filename);
            $biography->photourl = '/uploads/bio/'.$filename;
            $biography->update(); 
        }
      
      return redirect()->back();


    


    }

}