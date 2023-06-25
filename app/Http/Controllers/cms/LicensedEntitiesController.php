<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\LicensedEntity;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\LicensedEntityImport;
use Excel;

use Response;
use Validator;
use Redirect;
use Auth;

class LicensedEntitiesController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licensedEntities = LicensedEntity::orderBy('id', 'DESC')->get();
        return view('cms.licensed-entities.index', compact('licensedEntities'));
    }

    
    public function uploadLicensedEntity(Request $request)
    {
        $GLOBALS['category_id'] = $request->category_id;
        if($request->clear_available) LicensedEntity::where('category_id', $GLOBALS['category_id'])->delete();
        Excel::import(new LicensedEntityImport, $request->file);
        return  Redirect::back()->with('status','success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.licensed-entities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(LicensedEntity::$rules);

		/*$validator = Validator::make($data = , );

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }*/

        $data = $request->all();

/*        if ($request->hasFile('file_en'))
		{

			if ($request->file('file_en')->isValid())
			{
			    $file_url_en = $request->file('file_en');

				$doc_name_en = 'en'.time() . '-' .$file_url_en->getClientOriginalName();

				$pathName = '/uploads/licensedEntities/';

				$destinationPath = public_path().$pathName;

				$file_url_en->move($destinationPath, $doc_name_en);

				$data['file_en'] = $pathName.$doc_name_en;

			}
		}


        if ($request->hasFile('file_sw'))
        {

            if ($request->file('file_sw')->isValid())
            {
                $file_url_sw = $request->file('file_sw');

                $doc_name_sw = 'sw'.time() . '-' .$file_url_sw->getClientOriginalName();

                $pathName = '/uploads/licensedEntities/';

                $destinationPath = public_path().$pathName;

                $file_url_sw->move($destinationPath, $doc_name_sw);

                $data['file_sw'] = $pathName.$doc_name_sw;

            }
        }*/
         //$data['user_id'] = Auth::user()->id;
        $licensedEntity = LicensedEntity::create($data);

        if($licensedEntity){
            // return redirect('cms/licensed-entities')->with('status','success');
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
        $licensedEntity = LicensedEntity::find($id);
        return view("cms.licensed-entities.edit", compact('licensedEntity'));
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
    	$licensedEntity = LicensedEntity::find($id);

    	$request->validate(LicensedEntity::$rules);

        $data = $request->all();

        /*if ($request->hasFile('file_en'))
		{

			if ($request->file('file_en')->isValid())
			{
			    $file_url_en = $request->file('file_en');

				$doc_name_en = 'en'.time() . '-' .$file_url_en->getClientOriginalName();

				$pathName = '/uploads/licensedEntities/';

				$destinationPath = public_path().$pathName;

				$file_url_en->move($destinationPath, $doc_name_en);

				$data['file_en'] = $pathName.$doc_name_en;

				if(is_file(public_path().$licensedEntity->file_en) && file_exists(public_path().$licensedEntity->file_en)){
					unlink(public_path().$licensedEntity->file_en);
				}

			}
		}


		if ($request->hasFile('file_sw'))
		{

			if ($request->file('file_sw')->isValid())
			{
			    $file_url_sw = $request->file('file_sw');

				$doc_name_sw = 'sw'.time() . '-' .$file_url_sw->getClientOriginalName();

				$pathName = '/uploads/licensedEntities/';

				$destinationPath = public_path().$pathName;

				$file_url_sw->move($destinationPath, $doc_name_sw);

				$data['file_sw'] = $pathName.$doc_name_sw;

				if(is_file(public_path().$licensedEntity->file_sw) && file_exists(public_path().$licensedEntity->file_sw)){
					unlink(public_path().$licensedEntity->file_sw);
				}

			}
		}*/

        $licensedEntity->update($data);

        // return redirect('cms/licensed-entities')->with('status','success');
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

    	$licensedEntity = LicensedEntity::find($id);

	/*	if(is_file(public_path().$licensedEntity->file_en) && file_exists(public_path().$licensedEntity->file_en)){
			unlink(public_path().$licensedEntity->file_en);
		}

		if(is_file(public_path().$licensedEntity->file_sw) && file_exists(public_path().$licensedEntity->file_sw)){
			unlink(public_path().$licensedEntity->file_sw);
		}*/

		LicensedEntity::destroy($id);

        // return redirect('cms/licensed-entities')->with('status','success');
        return  Redirect::back()->with('status','success');
    }

}
