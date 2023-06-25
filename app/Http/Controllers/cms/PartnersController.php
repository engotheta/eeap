<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Partner;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
use Validator;

class PartnersController extends BaseController {


    public function index()
    {

        $partners = Partner::orderBy('id', 'DESC')->paginate(15);
        $select = Partner::orderBy('id', 'ASC')->pluck('title_en','title_sw','id')->toArray();
        return view('cms.partners.index', compact('partners','select'));
    }


    public function create()
    {
        return view('cms.partners.create');
    }

    public function store(Request $request)
    {

        $request->validate(Partner::$rules);

        $name = $request->input('active', '1');

        $inputs = $request->except('photo_url');

        $image = $request->get('photo_url'); // base64 image
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $type = explode(';', $image)[0];
        $type = explode('/', $type)[1]; // png or jpg etc

        $image = str_replace('data:image/'.$type.';base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(date('Ymdhis').'.'.$type);

        $path = public_path().'/uploads/partners/';

        if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

        \File::put($path.$imageName, base64_decode($image));

        $inputs['photo_url'] = $imageName;

        $partner= auth()->user()->partners()->save(new Partner($inputs));

        if($partner){
//          return back()->with('status', 'success');
          return redirect('cms/partners')->with('status', 'success');
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
        $partner = Partner::find($id);
        $select = Partner::orderBy('id', 'ASC')->pluck('title_en','title_sw','id')->toArray();
        return view("cms.partners.edit", compact('partner','select'));
    }


    public function update(Request $request, $id)
    {
        $partner = Partner::find($id);

        $request->validate(Partner::$rules);

        $inputs = $request->except('photo_url');

        $img = $request->get('photo_url');

        if($request->get('photo_url')){

            if(is_file(public_path().'/uploads/partners/'.$partner->photo_url) and file_exists(public_path().'/uploads/partners/'.$partner->photo_url)){
                unlink(public_path().'/uploads/partners/'.$partner->photo_url);
            }

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis').'.'.$type);

            $path = public_path().'/uploads/partners/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $inputs['photo_url'] = $imageName;

        }

        $inputs['user_id'] = auth()->user()->id;

        $partner->update($inputs);

        return redirect('cms/partners')->with('status', 'success');

    }

    public function destroy($id)
    {

        $partner= Partner::find($id);

        if(is_file(public_path().'/uploads/partners/'.$partner->photo_url) and file_exists(public_path().'/uploads/partners/'.$partner->photo_url)){
            unlink(public_path().'/uploads/partners/'.$partner->photo_url);
        }

        Partner::destroy($id);

        return back()->with('status', 'success');
    }

}
