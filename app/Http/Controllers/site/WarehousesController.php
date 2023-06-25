<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehousesController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$warehouses = Warehouse::orderBy('id', 'DESC')->where('active',1)->paginate(10);
        return view('site.warehouses.index', compact('warehouses'));
	}

	public function search(Request $request){
		$term = strip_tags($request->q);
		$warehouses = Warehouse::where('name', 'like', '%' . $term . '%')->orWhere('phone', 'like', '%' . $term . '%')->orWhere('location', 'like', '%' . $term . '%')->orWhere('email', 'like', '%' . $term . '%')->orderBy('id','DESC')->paginate(50);
		return view('site.warehouses.index', compact('warehouses','term'));
	}




	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$warehouse = Warehouse::findBySlug($slug);

		//if  content not found
		if(!$warehouse) return view('site.default-not-found');

		return view('site.warehouses.show', compact('warehouse'));
	}

	

}
