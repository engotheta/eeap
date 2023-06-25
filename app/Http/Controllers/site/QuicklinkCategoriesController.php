<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\QuicklinkCategory;
use App\Models\QuickLink;

class QuicklinkCategoriesController extends BaseSiteController {

	public function show($slug){
		$category = QuicklinkCategory::findBySlug($slug);
		$projects = $category->projects()->paginate(10);
		return view('site.projects.index', compact('projects'));
	}
}
