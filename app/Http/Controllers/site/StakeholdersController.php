<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Stakeholder;
use App\Models\StakeholderCategory;

class StakeholdersController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($category_slug) 
	{
		$category = StakeholderCategory::where('slug', $category_slug)->with('stakeholders')->first();
		$stakeholders = [];
		if($category) {
			$stakeholders = Stakeholder::orderBy('name', 'ASC')->orderBy('name','ASC')->where('category_id', $category->id)->paginate(20);
		}
		if(!$category) return view('site.default-not-found');
    	return view('site.stakeholders.index', compact('stakeholders','category'));
	}
	

	public function search(Request $request){
		$term = strip_tags($request->q);
		$category = StakeholderCategory::where('slug', $request->category)->with('stakeholders')->first();
		$stakeholders = Stakeholder::where('category_id', $category->id)->where(function ($q)  use ($term){
			$q->where('name', 'like', '%' . $term . '%')
			->orWhere('principal_officer', 'like', '%' . $term . '%')
			->orWhere('phone', 'like', '%' . $term . '%')
			->orWhere('region', 'like', '%' . $term . '%')
			->orWhere('license_type', 'like', '%' . $term . '%')
			->orWhere('class_of_business', 'like', '%' . $term . '%')
			->orWhere('principal_officer', 'like', '%' . $term . '%')
			->orWhere('address', 'like', '%' . $term . '%')
			->orWhere('email', 'like', '%' . $term . '%');
	})->orderBy('id','DESC')->paginate(5000);
		

		// whereHas('category', function($q) use ($category){
		// 	$q->where('id', $category->id);
  	// })
		
		return view('site.stakeholders.index', compact('stakeholders','term','category'));
	}




	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($categoy_slug, $entity_slug)
	{
		$stakeholder = Stakeholder::findBySlug($entity_slug);
		$category = StakeholderCategory::findBySlug($categoy_slug);

		//if  content not found
		if(!$stakeholder) return view('site.default-not-found');

		return view('site.stakeholders.show', compact('stakeholder','category'));
	}

	

}
