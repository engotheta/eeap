<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Achievements\SlugAchievement;

use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\SpecialPage;

use Image;

class AchievementsController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $achievements = Achievement::orderBy('id', 'DESC')->get();
        $specials = SpecialPage::pluck('title_en', 'id');

        return view('cms.achievements.index', compact('achievements','specials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specials = SpecialPage::pluck('title_en', 'id');

        return view('cms.achievements.create',compact('specials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Achievement::$rules);

        $data = $request->except('photo_url','icon');

        // if ($request->hasFile('icon'))
        // {
        //     if ($request->file('icon')->isValid())
        //     {
        //         $icon_url = $request->file('icon');

        //         $icon_name = 'icon-'.time();

        //         $pathName = '/uploads/achievements/';

        //         $destinationPath = public_path().$pathName;

        //         $icon_url->move($destinationPath, $icon_name);

        //         $data['icon'] = $icon_name;

        //     }
        // }


        if ($request->get('photo_url')) {
            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis').'.'.$type).'.'.$type;

            $path = public_path().'/uploads/achievements/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $data['photo_url'] = $imageName;
        }

        $achievement = Achievement::create($data);

        if($achievement){
            return redirect('cms/achievements')->with('status','success');
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
        $achievement = Achievement::find($id);
        $specials = SpecialPage::pluck('title_en', 'id');

        return view("cms.achievements.edit", compact('achievement','specials'));
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
    	$achievement = Achievement::find($id);

        $request->validate(Achievement::$rules_update);

        $data = $request->except('photo_url','icon');

        // if ($request->hasFile('icon'))
        // {
        //     if ($request->file('icon')->isValid())
        //     {
        //         $icon_url = $request->file('icon');

        //         $icon_name = 'icon-'.time();

        //         $pathName = '/uploads/achievements/';

        //         $destinationPath = public_path().$pathName;

        //         if(is_file(public_path().'/uploads/achievements/'.$achievement->icon) and file_exists(public_path().'/uploads/achievements/'.$achievement->icon)){
        //             unlink(public_path().'/uploads/achievements/'.$achievement->icon);
        //         }

        //         $icon_url->move($destinationPath, $icon_name);

        //         $data['icon'] = $icon_name;

        //     }
        // }

        if($request->get('photo_url')){

            if(is_file(public_path().'/uploads/achievements/'.$achievement->photo_url) and file_exists(public_path().'/uploads/achievements/'.$achievement->photo_url)){
                unlink(public_path().'/uploads/achievements/'.$achievement->photo_url);
            }

            $image = $request->get('photo_url'); // base64 image
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $type = explode(';', $image)[0];
            $type = explode('/', $type)[1]; // png or jpg etc

            $image = str_replace('data:image/'.$type.';base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = md5(date('Ymdhis').'.'.$type).'.'.$type;

            $path = public_path().'/uploads/achievements/';

            if(! \File::exists($path)):  \File::makeDirectory($path, $mode = 0644, true, true); endif;

            \File::put($path.$imageName, base64_decode($image));

            $data['photo_url'] = $imageName;

        }

        $achievement->update($data);

        return redirect('cms/achievements')->with('status','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $achievement = Achievement::find($id);

        // if(is_file(public_path().'/uploads/achievements/'.$achievement->icon) and file_exists(public_path().'/uploads/achievements/'.$achievement->icon)){
        //     unlink(public_path().'/uploads/achievements/'.$achievement->icon);
        // }

        if(is_file(public_path().'/uploads/achievements/'.$achievement->photo_url) and file_exists(public_path().'/uploads/achievements/'.$achievement->photo_url)){
            unlink(public_path().'/uploads/achievements/'.$achievement->photo_url);
        }

        $achievement->delete();
        
        return redirect('cms/achievements')->with('status','success');
    }

}
