<?php namespace App\Http\Controllers\site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\AdministrationCategories;
use App\Models\AdministrationCategoriesMembers;

class AdministrationController extends BaseSiteController {


	public function show($slug,$id)
	{
		$category = AdministrationCategories::findBySlug($slug);
        $member = Administration::findBySlug($id);

		//if  content not found
		if(!$member) return view('site.default-not-found');
		
		return view('site.administration.show', compact('category', 'member'));
	}

	public function index($slug)
	{
        $category = AdministrationCategories::findBySlug($slug);

		//if  content not found
		if(!$category) return view('site.default-not-found');

        $category_members = AdministrationCategoriesMembers::where('category_id', $category->id)->orderBy('position', 'ASC')->with('member')->get();
		$members = array(); //initialize empty members array...

		//fill the members array by creating a multidimensional array based on the positions...
		foreach ($category_members as $key => $value) {
			$members[$value->position][] = $value;
		}

		return view('site.administration.index', compact('category', 'members'));
	}
    
    public function members()
	{
        $members = Administration::orderBy('position', 'DESC')->paginate(10);
		
		return view('site.administration.members', compact('members'));
	}
}
