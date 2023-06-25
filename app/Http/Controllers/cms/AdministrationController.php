<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\AdministrationCategories;
use Response;
use Validator;
use Redirect;
use Image;
use Auth;

class AdministrationController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administration = Administration::orderBy('id', 'DESC')->get();
        $categories = AdministrationCategories::pluck('title_en', 'id');
        return view('cms.administration.index', compact('administration', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.administration.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Administration::$rules);

        $data = $request->except('photo_url');

        $image = $request->get('photo_url'); // base64 image
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $type = explode(';', $image)[0];
        $type = explode('/', $type)[1]; // png or jpg etc

        $image = str_replace('data:image/'.$type.';base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(date('Ymdhis')).'.'.$type;

        $path = public_path().'/uploads/administration/';

        if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

        \File::put($path.$imageName, base64_decode($image));

        $data['photo_url'] = $imageName;

        $administration = Administration::create($data);

        if($administration){
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
        $administration = Administration::find($id);
        $categories = AdministrationCategories::pluck('title_en', 'id');
        return view("cms.administration.edit", compact('administration', 'categories'));
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
        $administration = Administration::find($id);

        $rules = [
            'fullname' => 'required',
            'title_en' => 'required',
            'title_sw' => 'required',
        ];

        $request->validate($rules);

        $data = $request->except('photo_url');

        $data = $request->except('photo_url');

        if($request->get('photo_url')){

            if(is_file(public_path().'/uploads/administration/'.$administration->photo_url) and file_exists(public_path().'/uploads/administration/'.$administration->photo_url)){
                unlink(public_path().'/uploads/administration/'.$administration->photo_url);
            }

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path = public_path().'/uploads/administration/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $data['photo_url'] = $imageName;

        }

        $administration->update($data);

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

        $administration = Administration::find($id);

        if(is_file(public_path().'/uploads/administration/'.$administration->photo_url) and file_exists(public_path().'/uploads/administration/'.$administration->photo_url)){
            unlink(public_path().'/uploads/administration/'.$administration->photo_url);
        }

        $administration->member_categories()->delete();
        Administration::destroy($id);

        return back()->with('status', 'success');
    }

}
