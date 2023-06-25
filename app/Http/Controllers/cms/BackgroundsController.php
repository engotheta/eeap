<?php
namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Background;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Response;
use Validator;
use Redirect;
use Auth;

class BackgroundsController extends BaseController {

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $backgrounds = Background::orderBy('id', 'DESC')->first();
        return view('cms.backgrounds.index', compact('backgrounds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('cms/backgrounds');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Background::$rules);

//        if ($request->hasFile('second_bg')){
//            $request->validate(Background::$rules_second_bg);
//        }

        $data = [];

        if ($request->hasFile('main_bg'))
        {

            if ($request->file('main_bg')->isValid())
            {
                $main_bg = $request->file('main_bg');

                $main_bg_name = time() . '-' .$main_bg->getClientOriginalName();

                $pathName = '/uploads/backgrounds/';

                $destinationPath = public_path().$pathName;

                $main_bg->move($destinationPath, $main_bg_name);

                $data['main_bg'] = $pathName.$main_bg_name;

            }
        }


        // if ($request->hasFile('banner_bg'))
        // {

        //     if ($request->file('banner_bg')->isValid())
        //     {
        //         $banner_bg = $request->file('banner_bg');

        //         $banner_bg_name = time() . '-' .$banner_bg->getClientOriginalName();

        //         $pathName = '/uploads/backgrounds/';

        //         $destinationPath = public_path().$pathName;

        //         $banner_bg->move($destinationPath, $banner_bg_name);

        //         $data['banner_bg'] = $pathName.$banner_bg_name;

        //     }
        // }


        // if ($request->hasFile('second_bg'))
        // {

        //     if ($request->file('second_bg')->isValid())
        //     {
        //         $second_bg = $request->file('second_bg');

        //         $second_bg_name = time() . '-' .$second_bg->getClientOriginalName();

        //         $pathName = '/uploads/backgrounds/';

        //         $destinationPath = public_path().$pathName;

        //         $second_bg->move($destinationPath, $second_bg_name);

        //         $data['second_bg'] = $pathName.$second_bg_name;

        //     }
        // }

        $data['user_id'] = Auth::user()->id;
        $background = Background::create($data);

        if($background){
            return redirect('cms/backgrounds')->with('status', 'success');
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
        return redirect('cms/backgrounds');
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
    	$background = Background::find($id);

        $data = [];

        if ($request->hasFile('main_bg')){
            $request->validate(Background::$rules_main_bg);
        }
        // if ($request->hasFile('banner_bg')){
        //     $request->validate(Background::$rules_banner_bg);
        // }
        // if ($request->hasFile('second_bg')){
        //     $request->validate(Background::$rules_second_bg);
        // }


        if ($request->hasFile('main_bg'))
        {
            if ($request->file('main_bg')->isValid())
            {
                $main_bg = $request->file('main_bg');

                $main_bg_name = time() . '-' .$main_bg->getClientOriginalName();

                $pathName = '/uploads/backgrounds/';

                $destinationPath = public_path().$pathName;

                $main_bg->move($destinationPath, $main_bg_name);

                $data['main_bg'] = $pathName.$main_bg_name;

                if(is_file(public_path().$background->main_bg) && file_exists(public_path().$background->main_bg)){
                    unlink(public_path().$background->main_bg);
                }

            }
        }


		// if ($request->hasFile('banner_bg'))
		// {
		// 	if ($request->file('banner_bg')->isValid())
		// 	{
		// 	    $banner_bg = $request->file('banner_bg');

		// 		$banner_bg_name = time() . '-' .$banner_bg->getClientOriginalName();

		// 		$pathName = '/uploads/backgrounds/';

		// 		$destinationPath = public_path().$pathName;

		// 		$banner_bg->move($destinationPath, $banner_bg_name);

		// 		$data['banner_bg'] = $pathName.$banner_bg_name;

		// 		if(is_file(public_path().$background->banner_bg) && file_exists(public_path().$background->banner_bg)){
		// 			unlink(public_path().$background->banner_bg);
		// 		}

		// 	}
		// }


        // if ($request->hasFile('second_bg'))
        // {
        //     if ($request->file('second_bg')->isValid())
        //     {
        //         $second_bg = $request->file('second_bg');

        //         $second_bg_name = time() . '-' .$second_bg->getClientOriginalName();

        //         $pathName = '/uploads/backgrounds/';

        //         $destinationPath = public_path().$pathName;

        //         $second_bg->move($destinationPath, $second_bg_name);

        //         $data['second_bg'] = $pathName.$second_bg_name;

        //         if(is_file(public_path().$background->second_bg) && file_exists(public_path().$background->second_bg)){
        //             unlink(public_path().$background->second_bg);
        //         }

        //     }
        // }

        $background->update($data);

        return back()->with('status', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    	$background = Background::find($id);

	 	if(is_file(public_path().$background->main_bg) && file_exists(public_path().$background->main_bg)){
			unlink(public_path().$background->main_bg);
		}

		// if(is_file(public_path().$background->banner_bg) && file_exists(public_path().$background->banner_bg)){
		// 	unlink(public_path().$background->banner_bg);
        // }

        // if(is_file(public_path().$background->second_bg) && file_exists(public_path().$background->second_bg)){
        //     unlink(public_path().$background->second_bg);
        // }

		$background->delete();

        return redirect('cms/backgrounds')->with('status', 'success');
    }

}
