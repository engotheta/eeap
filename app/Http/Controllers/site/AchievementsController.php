<?php

namespace App\Http\Controllers\site;

use App\Models\Achievement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AchievementsController extends BaseSiteController
{
    public function index()
	{
		$achievements = Achievement::where('active',1)->orderBy('id','DESC')->paginate(5);
		return view('site.achievements.index', compact('achievements'));
	}


    public function show($slug)
    {
        $achievement = Achievement::findBySlug($slug);

        //if  content not found
		if(!$achievement) return view('site.default-not-found');

        return view('site.achievements.show', compact('achievement'));
    }

}
