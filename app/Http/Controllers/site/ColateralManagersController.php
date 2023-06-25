<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ColateralManager;

class ColateralManagersController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$colateralManagers = ColateralManager::orderBy('id', 'DESC')->where('active',1)->paginate(10);
        return view('site.colateral_managers.index', compact('colateralManagers'));
	}

	public function search(Request $request){
		$term = strip_tags($request->q);
		$colateralManagers = ColateralManager::where('name', 'like', '%' . $term . '%')->orWhere('phone', 'like', '%' . $term . '%')->orWhere('address', 'like', '%' . $term . '%')->orWhere('email', 'like', '%' . $term . '%')->orderBy('id','DESC')->paginate(50);
		return view('site.colateral_managers.index', compact('colateralManagers','term'));
	}




	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$colateralManager = ColateralManager::findBySlug($slug);

		//if  content not found
		if(!$colateralManager) return view('site.default-not-found');

		return view('site.colateral_managers.show', compact('colateralManager'));
	}

	

}
