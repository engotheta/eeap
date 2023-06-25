<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\AdministrationCategories;
use App\Models\Administration;

class AdministrationCategoriesController extends BaseSiteController {

	public function show($slug){
		$category = AdministrationCategories::findBySlug($slug);
		$administration = $category->administration();
		
		//if  content not found
		if(!$category) return view('site.default-not-found');

		return view('site.administration.index', compact('administration','category'));
	}
}
