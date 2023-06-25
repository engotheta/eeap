<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Operator;

class OperatorsController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$operators = Operator::orderBy('id', 'DESC')->where('active',1)->paginate(10);
        return view('site.operators.index', compact('operators'));
	}

	public function search(Request $request){
		$term = strip_tags($request->q);
		$operators = Operator::where('name', 'like', '%' . $term . '%')->orWhere('phone', 'like', '%' . $term . '%')->orWhere('address', 'like', '%' . $term . '%')->orWhere('email', 'like', '%' . $term . '%')->orderBy('id','DESC')->paginate(50);
		return view('site.operators.index', compact('operators','term'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$operator = Operator::findBySlug($slug);

		//if  content not found
		if(!$operator) return view('site.default-not-found');

		return view('site.operators.show', compact('operator'));
	}

	

}
