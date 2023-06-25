<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\LicensedEntity;
use App\Models\LicensedEntityCategory;

class LicensedEntitiesController extends BaseSiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($category_slug) 
	{
		$category = LicensedEntityCategory::where('slug', $category_slug)->with('licensedEntities')->first();
		// $licensedEntities = $category->licensedEntities();
		$licensedEntities = LicensedEntity::orderBy('name', 'ASC')->orderBy('name','ASC')->where('category_id', $category->id)->paginate(20);


    return view('site.licensed-entities.index', compact('licensedEntities','category'));
	}
	

	public function search(Request $request){
		$term = strip_tags($request->q);
		$category = LicensedEntityCategory::where('slug', $request->category)->with('licensedEntities')->first();
		$licensedEntities = LicensedEntity::where('category_id', $category->id)->where(function ($q)  use ($term){
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
		
		return view('site.licensed-entities.index', compact('licensedEntities','term','category'));
	}




	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($category_slug, $entity_slug)
	{
		$licensedEntity = LicensedEntity::findBySlug($entity_slug);

		//if  content not found
		if(!$licensedEntity) return view('site.default-not-found');

		return view('site.licensed-entities.show', compact('licensedEntity'));
	}

	

}
