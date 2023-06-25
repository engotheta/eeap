<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Operator;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Response;
use Validator;
use Redirect;
use Auth;

class OperatorsController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = Operator::orderBy('id', 'DESC')->get();
        return view('cms.operators.index', compact('operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.operators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Operator::$rules);

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

				$pathName = '/uploads/operators/';

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

                $pathName = '/uploads/operators/';

                $destinationPath = public_path().$pathName;

                $file_url_sw->move($destinationPath, $doc_name_sw);

                $data['file_sw'] = $pathName.$doc_name_sw;

            }
        }*/
         //$data['user_id'] = Auth::user()->id;
        $operator = Operator::create($data);

        if($operator){
            return redirect('cms/operators')->with('status','success');
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
        $operator = Operator::find($id);
        return view("cms.operators.edit", compact('operator'));
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
    	$operator = Operator::find($id);

    	$request->validate(Operator::$rules);

        $data = $request->all();

        /*if ($request->hasFile('file_en'))
		{

			if ($request->file('file_en')->isValid())
			{
			    $file_url_en = $request->file('file_en');

				$doc_name_en = 'en'.time() . '-' .$file_url_en->getClientOriginalName();

				$pathName = '/uploads/operators/';

				$destinationPath = public_path().$pathName;

				$file_url_en->move($destinationPath, $doc_name_en);

				$data['file_en'] = $pathName.$doc_name_en;

				if(is_file(public_path().$operator->file_en) && file_exists(public_path().$operator->file_en)){
					unlink(public_path().$operator->file_en);
				}

			}
		}


		if ($request->hasFile('file_sw'))
		{

			if ($request->file('file_sw')->isValid())
			{
			    $file_url_sw = $request->file('file_sw');

				$doc_name_sw = 'sw'.time() . '-' .$file_url_sw->getClientOriginalName();

				$pathName = '/uploads/operators/';

				$destinationPath = public_path().$pathName;

				$file_url_sw->move($destinationPath, $doc_name_sw);

				$data['file_sw'] = $pathName.$doc_name_sw;

				if(is_file(public_path().$operator->file_sw) && file_exists(public_path().$operator->file_sw)){
					unlink(public_path().$operator->file_sw);
				}

			}
		}*/

        $operator->update($data);

        return redirect('cms/operators')->with('status','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    	$operator = Operator::find($id);

	/*	if(is_file(public_path().$operator->file_en) && file_exists(public_path().$operator->file_en)){
			unlink(public_path().$operator->file_en);
		}

		if(is_file(public_path().$operator->file_sw) && file_exists(public_path().$operator->file_sw)){
			unlink(public_path().$operator->file_sw);
		}*/

		Operator::destroy($id);

        return redirect('cms/operators')->with('status','success');
    }

}
