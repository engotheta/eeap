<?php

namespace App\Http\Controllers\site;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends BaseSiteController
{
    public function index()
	{
		$services = Service::where('active',1)->orderBy('id','DESC')->paginate(5);
		return view('site.services.index', compact('services'));
	}


    public function show($slug)
    {
        $service = Service::findBySlug($slug);

        //if  content not found
		if(!$service) return view('site.default-not-found');

        return view('site.services.show', compact('service'));
    }

}
