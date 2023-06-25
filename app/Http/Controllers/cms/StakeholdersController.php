<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Stakeholder;
use App\Models\StakeholderCategory;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Excel;

use Response;
use Validator;
use Redirect;
use Auth;

class StakeholdersController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stakeholders = Stakeholder::orderBy('id', 'DESC')->get();
        return view('cms.stakeholders.index', compact('stakeholders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.stakeholders.create');
    }

    public function add($slug)
    {
        $category = StakeholderCategory::where('slug',$slug)->first();
        return view('cms.stakeholders.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Stakeholder::$rules);

		/*$validator = Validator::make($data = , );

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }*/

        $data = $request->except('photo_url','file');

        $img = $request->get('photo_url',);

        if($request->get('photo_url')){
            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path = public_path().'/uploads/stakeholders/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $data['photo_url'] = $imageName;

        }
         //$data['user_id'] = Auth::user()->id;
        $stakeholder = Stakeholder::create($data);

        if($stakeholder){
            // return redirect('cms/stakeholders')->with('status','success');
            return  Redirect::back()->with('status','success');
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
        $stakeholder = Stakeholder::find($id);
        $category = StakeholderCategory::find($stakeholder->category_id);
        return view("cms.stakeholders.edit", compact('stakeholder','category'));
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
    	$stakeholder = Stakeholder::find($id);

    	$request->validate(Stakeholder::$rules);

        $data = $request->except('photo_url');

        $img = $request->get('photo_url');

        if($request->get('photo_url')){

            if(is_file(public_path().'/uploads/stakeholders/'.$stakeholder->photo_url) and file_exists(public_path().'/uploads/stakeholders/'.$stakeholder->photo_url)){
                unlink(public_path().'/uploads/stakeholders/'.$stakeholder->photo_url);
            }

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis')).'.'.$type;

            $path = public_path().'/uploads/stakeholders/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $data['photo_url'] = $imageName;

        }
        $stakeholder->update($data);

        // return redirect('cms/stakeholders')->with('status','success');
        return  Redirect::back()->with('status','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    	$stakeholder = Stakeholder::find($id);

	/*	if(is_file(public_path().$stakeholder->file_en) && file_exists(public_path().$stakeholder->file_en)){
			unlink(public_path().$stakeholder->file_en);
		}

		if(is_file(public_path().$stakeholder->file_sw) && file_exists(public_path().$stakeholder->file_sw)){
			unlink(public_path().$stakeholder->file_sw);
		}*/

		Stakeholder::destroy($id);

        // return redirect('cms/stakeholders')->with('status','success');
        return  Redirect::back()->with('status','success');
    }

}
