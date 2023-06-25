<?php

namespace App\Http\Controllers\site;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectsController extends BaseSiteController
{
    public function index()
	{
		$projects = Project::where('active',1)->orderBy('id','DESC')->paginate(6);
		return view('site.projects.index', compact('projects'));
	}


    public function show($slug)
    {
        $project = Project::findBySlug($slug);

        //if  content not found
		if(!$project) return view('site.default-not-found');

        return view('site.projects.show', compact('project'));
    }

}
