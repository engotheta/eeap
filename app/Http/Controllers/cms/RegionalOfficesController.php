<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Department;
use App\Models\RegionalOffice;
use Illuminate\Http\Request;
use DB;

class RegionalOfficesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $regional_offices = RegionalOffice::orderBy('headquarter', 'DESC')->orderBy('id', 'DESC')->get();
        return view('cms.regional_office.index', compact('regional_offices'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('cms.regional_office.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $request->validate(RegionalOffice::$rules);
        // $request['headquarter'] = true;
        $inputs = $request->all();

//        if($request->headquarter==true){
//        	DB::table('regional_offices')->update(['headquarter' => false]);
//        }

        $regional_office = RegionalOffice::create($inputs);

        if($regional_office){
			return back()->with('status', 'success');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $regional_office = RegionalOffice::find($id);

        return view("cms.regional_office.edit", compact('regional_office'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $request->validate(RegionalOffice::$rules);

        $inputs = $request->all();

        $regional_office = RegionalOffice::find($id);

        $regional_office->update($inputs);

		return back()->with('status', 'success');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $regional_office = RegionalOffice::find($id);

		$regional_office->maps()->delete();

		$regional_office->delete();

		return back()->with('status', 'success');
	}

}
