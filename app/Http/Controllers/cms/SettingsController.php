<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Http\Request;
use App\Models\Setting;


class SettingsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$settings = Setting::orderBy('id', 'DESC')->get();
        return view('cms.settings.index', compact('settings'));
	}

	public function edit($id)
	{
		$setting = Setting::find($id);

		return view('cms.settings.edit', compact('setting'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function store(Request $request)
	{
		$request->validate(Setting::$rules);


        $inputs = $request->except('title_en','content_en');

		//$setting = Setting::find($id);

		$setting=Setting::create($inputs);

		 if(request('title_en')){
            app()->setLocale('en');
            $setting->title=request('title_en');
            $setting->save();
         }

         if(request('content_en')){
            app()->setLocale('en');
            $setting->content=request('content_en');
            $setting->save();
         }

            $setting->slug=null;
            $setting->save();

            $slug = SlugService::createSlug(Setting::class, 'slug', $request->title);

            $setting->slug=$slug;
            $setting->save();

        return redirect('cms/settings');

	}*/

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
//	    dd($request->all());
		$request->validate(Setting::$rules);

        $inputs = $request->all();

		$setting = Setting::find($id);

		$setting->update($inputs);

        return redirect('cms/settings');

	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        Setting::destroy($id);

        return redirect('cms/settings');
    }
*/

}
