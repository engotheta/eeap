<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Http\Request;
use App\Models\Project;

use Image;

class ProjectsController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'DESC')->get();

        return view('cms.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Project::$rules);

        $data = $request->except('photo_url');

        if ($request->get('photo_url')) {
            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis').'.'.$type).'.'.$type;

            $path = public_path().'/uploads/projects/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $data['photo_url'] = $imageName;
        }

        $project = Project::create($data);

        if($project){
            return redirect('cms/projects')->with('status','success');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view("cms.projects.edit", compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$project = Project::find($id);

        $request->validate(Project::$rules_update);

        $data = $request->except('photo_url');

        if($request->get('photo_url')){

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis').'.'.$type).'.'.$type;

            $path = public_path().'/uploads/projects/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            // delete the old file...
            if(is_file(public_path().'/uploads/projects/'.$project->photo_url) and file_exists(public_path().'/uploads/projects/'.$project->photo_url)){
                unlink(public_path().'/uploads/projects/'.$project->photo_url);
            }

            $data['photo_url'] = $imageName;

        }

        $project->update($data);

        return redirect('cms/projects')->with('status','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    	$project = Project::find($id);

  		// delete the old file...
        if(is_file(public_path().'/uploads/projects/'.$project->photo_url) and file_exists(public_path().'/uploads/projects/'.$project->photo_url)){
            unlink(public_path().'/uploads/projects/'.$project->photo_url);
        }

  		$project->delete();

        return redirect('cms/projects')->with('status','success');
    }

}
