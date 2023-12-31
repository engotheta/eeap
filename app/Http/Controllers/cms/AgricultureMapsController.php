<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AgricultureMap;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Image;

class AgricultureMapsController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            $availables= $ltr->availableLocales();
            dd($availables);
        */
        $agricultureMaps = AgricultureMap::orderBy('id', 'DESC')->get();
        return view('cms.agriculture-maps.index', compact('agricultureMaps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.agriculture-maps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(AgricultureMap::$rules);

        $name = $request->input('active', '1');

        $inputs = $request->except('photo_url');

        $image = $request->get('photo_url'); // base64 image
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $type = explode(';', $image)[0];
        $type = explode('/', $type)[1]; // png or jpg etc

        $image = str_replace('data:image/'.$type.';base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(date('Ymdhis')).'.'.$type;

        $path = public_path().'/uploads/agriculture-maps/';

        if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

        \File::put($path.$imageName, base64_decode($image));

        $inputs['photo_url'] = $imageName;

        $agricultureMap = auth()->user()->agricultureMaps()->save(new AgricultureMap($inputs));

        if($agricultureMap){
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
        $agricultureMap = AgricultureMap::find($id);
        return view("cms.agriculture-maps.edit", compact('agricultureMap'));
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
        $agricultureMap= AgricultureMap::find($id);

        $request->validate(AgricultureMap::$rules_update);

        $inputs = $request->except('photo_url');

        $img = $request->get('photo_url');

        if($request->get('photo_url')){

            if(is_file(public_path().'/uploads/agriculture-maps/'.$agricultureMap->photo_url) and file_exists(public_path().'/uploads/agriculture-maps/'.$agricultureMap->photo_url)){
                unlink(public_path().'/uploads/agriculture-maps/'.$agricultureMap->photo_url);
            }

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path = public_path().'/uploads/agriculture-maps/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $inputs['photo_url'] = $imageName;

        }

        $inputs['user_id'] = auth()->user()->id;

        $agricultureMap->update($inputs);

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

        $agricultureMap = AgricultureMap::find($id);

		if(is_file(public_path().'/uploads/agriculture-maps/'.$agricultureMap->photo_url) and file_exists(public_path().'/uploads/agriculture-maps//'.$agricultureMap->photo_url)){
			unlink(public_path().'/uploads/agriculture-maps/'.$agricultureMap->photo_url);
        }

        AgricultureMap::destroy($id);
        //return redirect('cms/agricultureMap');
        return back()->with('status', 'success');
    }

}
