<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Http\Request;
use App\Models\Seo;

class SeoController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$seo = Seo::orderBy('id', 'DESC')->first();
        return view('cms.seo.index', compact('seo'));
	}

	public function edit($id)
	{
		$setting = Seo::find($id);
		return view('cms.seo.edit', compact('setting'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
			$request->validate(SEO::$rules);

			$inputs = $request->all();

			$link = Seo::create($inputs);

			return back()->with('status', 'success');

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $request->validate(Seo::$rules);

        $inputs = $request->all();

		$setting = Seo::find($id);

		$setting->update($inputs);

		return back()->with('status', 'success');

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
