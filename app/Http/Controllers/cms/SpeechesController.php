<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Speech;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Response;
use Validator;
use Redirect;
use Auth;

class SpeechesController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $speeches = Speech::orderBy('id', 'DESC')->get();
        return view('cms.speeches.index', compact('speeches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.speeches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Speech::$rules);

		/*$validator = Validator::make($data = , );

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }*/

        $data = $request->all();

        if ($request->hasFile('file_en'))
		{

			if ($request->file('file_en')->isValid())
			{
			    $file_url_en = $request->file('file_en');

				$doc_name_en = 'en'.time() . '-' .$file_url_en->getClientOriginalName();

				$pathName = '/uploads/speeches/';

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

                $pathName = '/uploads/speeches/';

                $destinationPath = public_path().$pathName;

                $file_url_sw->move($destinationPath, $doc_name_sw);

                $data['file_sw'] = $pathName.$doc_name_sw;

            }
        }
        $data['user_id'] = Auth::user()->id;
        $speech = Speech::create($data);

        if($speech){
            return redirect('cms/speeches')->with('status', 'success');
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
        $speech = Speech::find($id);
        return view("cms.speeches.edit", compact('speech'));
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
    	$speech = Speech::find($id);

    	$request->validate(Speech::$rules_update);

        $data = $request->except('file_en','file_sw');

        if ($request->hasFile('file_en'))
		{

			if ($request->file('file_en')->isValid())
			{
			    $file_url_en = $request->file('file_en');

				$doc_name_en = 'en'.time() . '-' .$file_url_en->getClientOriginalName();

				$pathName = '/uploads/speeches/';

				$destinationPath = public_path().$pathName;

				$file_url_en->move($destinationPath, $doc_name_en);

				$data['file_en'] = $pathName.$doc_name_en;

				if(is_file(public_path().$speech->file_en) && file_exists(public_path().$speech->file_en)){
					unlink(public_path().$speech->file_en);
				}

			}
		}


		if ($request->hasFile('file_sw'))
		{

			if ($request->file('file_sw')->isValid())
			{
			    $file_url_sw = $request->file('file_sw');

				$doc_name_sw = 'sw'.time() . '-' .$file_url_sw->getClientOriginalName();

				$pathName = '/uploads/speeches/';

				$destinationPath = public_path().$pathName;

				$file_url_sw->move($destinationPath, $doc_name_sw);

				$data['file_sw'] = $pathName.$doc_name_sw;

				if(is_file(public_path().$speech->file_sw) && file_exists(public_path().$speech->file_sw)){
					unlink(public_path().$speech->file_sw);
				}

			}
		}

        $speech->update($data);

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

    	$speech = Speech::find($id);

	 	if(is_file(public_path().$speech->file_en) && file_exists(public_path().$speech->file_en)){
			unlink(public_path().$speech->file_en);
		}

		if(is_file(public_path().$speech->file_sw) && file_exists(public_path().$speech->file_sw)){
			unlink(public_path().$speech->file_sw);
        }

		Speech::destroy($id);

        return redirect('cms/speeches')->with('status', 'success');
    }

}
