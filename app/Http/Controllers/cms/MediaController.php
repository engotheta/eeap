<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Audio;
use App\Models\Photo;
use App\Models\Gallery;
use Carbon\Carbon;

use Image;


class MediaController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($galleryID)
    {
        $gallery = Gallery::findOrFail($galleryID);
        if($gallery->type == 'videos'){
            $media =  new Video();
        }
        elseif($gallery->type == 'photos') {
            $media = new Photo();
        }else {
            $media = new Audio();
        }

        $galleries = Gallery::where('id','!=',$galleryID)->pluck('title_en', 'id');
        $media->gallery_id = $gallery->id;
        return view('cms.media.index',compact('media','gallery','galleries'));
    }


    public function create($galleryID)
    {
      $gallery = Gallery::findOrFail($galleryID);
      if($gallery->type == 'videos'){
          $media =  new Video();
      }
      elseif($gallery->type == 'photos') {
          $media = new Photo();
      }else {
          $media = new Audio();
      }

      $media->gallery_id = $gallery->id;
      return view('cms.media.create',compact('media','gallery'));
    }


    public function bulk($galleryID)
    {
      $gallery = Gallery::findOrFail($galleryID);
      if($gallery->type == 'videos'){
          $media =  new Video();
      }
      elseif($gallery->type == 'photos') {
          $media = new Photo();
      }else {
          $media = new Audio();
      }

      $media->gallery_id = $gallery->id;
      return view('cms.media.bulk_upload',compact('media','gallery'));
    }


    public function store(Request $request)
    {
        $rules=[];
        if($request->type=='videos'){
            $model = new Video();
            $rules = Video::$rules;
        }
        elseif($request->type=='photos'){
            $model = new Photo();
            $rules = Photo::$rules;
        }else {
            $model = new Audio();
            $rules = Audio::$rules;
        }


        $request->validate($rules);

        $gallery = Gallery::findOrFail($request->gallery_id);

        if ($gallery) {
          $data = $request->except('mediaurl','type');
          $data['gallery_id'] = $gallery->id;
          // upload base 64 image
          if ($request->get('mediaurl')) {
            $image = $request->get('mediaurl'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path = public_path().'/uploads/gallery/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            // end of upload base 64 image

            $data['path']='/uploads/gallery/';
            $data['filename'] = $imageName;
            $data['mime'] = 'images/'.$type;

            if($request->type == 'audio'){

                $data['url']=$audio_filename;
                $data['filename']=$filename;

            }
          }



          $media=$model::create($data);

        }

        return back()->with('status', 'success');
    }


    public function show($slug)
    {

    }


    public function edit($id)
    {
        $media = Photo::findOrFail($id);
        return view('cms.media.edit',compact('media'));
    }

    public function update($id,Request $request)
    {

        $data = $request->except('mediaurl','type','file');
        $media = Photo::findOrFail($id);

        if($request->get('mediaurl')){

            if(is_file(public_path().'/uploads/gallery/'.$media->filename) and file_exists(public_path().'/uploads/gallery/'.$media->filename)){
                unlink(public_path().'/uploads/gallery/'.$media->filename);
            }

            $image = $request->get('mediaurl'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path = public_path().'/uploads/gallery/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $data['path']='/uploads/gallery/';
            $data['filename']=$imageName;
            $data['mime'] = 'images/'.$type;
        }

        $media->update($data);

        return back()->with('status', 'success');
    }

    public function transferMedia($id,Request $request)
    {

        $data = $request->all();
        $media = Photo::findOrFail($id);

        $media->update($data);
        if ($media) {
          return back()->with('status', 'success');
        }
    }

    public function transferGallery($id,Request $request)
    {

        $data = $request->all();

        $gallery = Gallery::findOrFail($id);

        $media = Photo::select('id')->where('gallery_id',$id)->get();
        foreach ($media as $key => $value) {
          $value->update($data);
        }

        if ($media) {
          return back()->with('status', 'success');
        }
    }

    public function bulkUpload($id,Request $request)
    {
        $model = new Photo();

        $data = $request->except('file');

      if($request->hasFile('file')) {

        // Upload path
        $path = public_path().'/uploads/gallery/';

        // Create directory if not exists
        if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

        // Get file extension
        $extension = $request->file('file')->getClientOriginalExtension();

        // Valid extensions
        $validextensions = array("jpeg","jpg","png");

        // Check extension
        if(in_array(strtolower($extension), $validextensions)){

          // Rename file
          $fileName = md5(date('Ymdhis')) .'.' . $extension;

          // Uploading file to given path
          \File::put($path.$fileName, $request->file('file'));

          $request->file('file')->move($path, $fileName);

        }
        $data['mime'] = 'images/'.$extension;
        $data['path'] = '/uploads/gallery/';
        $data['filename'] = $fileName;

      }

      $model->create($data);
        if ($model) {
          return back()->with('status', 'success');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Video::find($id);

        if(file_exists(public_path().$media->path.$media->filename) && is_file(public_path().$media->path.$media->filename)){
            unlink(public_path().$media->path.$media->filename);
        }

        $media->delete();
        return back()->with('status', 'success');
    }

}
