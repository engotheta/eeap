<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\GoogleMap;
use App\Models\RegionalOffice;

use Response;
use Validator;
use Redirect;
use Auth;

class GoogleMapsController extends BaseController {

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regional_offices = RegionalOffice::orderBy('headquarter', 'DESC')->get()->map(function($off,$index) {
            return (object)['name'=>$off->name,'id'=>$off->id];
        });
        // $regional_offices = $regional_offices->merge(collect([(object)['name'=>'Warehouses','id'=>999]]));

        $google_maps = GoogleMap::orderBy('id', 'DESC')->with('office')->get()->map(function($map,$index) {
            // if($map->office_id == 999) $map->office = (object)['name'=>'Warehouses','id'=>999];
            return $map;
        });

        return view('cms.google_maps.index', compact('google_maps','regional_offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regional_offices = RegionalOffice::orderBy('headquarter', 'DESC')->get()->map(function($off,$index) {
            return (object)['name'=>$off->name,'id'=>$off->id];
        });
        // $regional_offices = $regional_offices->merge(collect([(object)['name'=>'Warehouses','id'=>999]]));

        $google_maps = GoogleMap::orderBy('id', 'DESC')->with('office')->get()->map(function($map,$index) {
            // if($map->office_id == 999) $map->office = (object)['name'=>'Warehouses','id'=>999];
            return $map;
        });
        
        return view('cms.google_maps.create', compact('regional_offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(GoogleMap::$rules);

        $data = $request->all();
        $data['user_id']=Auth::user()->id;

        $GoogleMap = GoogleMap::create($data);

        if($GoogleMap){
            return redirect('cms/googlemaps');
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
        $google_map = GoogleMap::find($id);
        // if($google_map->office_id == 999) $google_map->office = (object)['name'=>'Warehouses','id'=>999];

        $regional_offices = RegionalOffice::orderBy('headquarter', 'DESC')->get()->map(function($off,$index) {
            return (object)['name'=>$off->name,'id'=>$off->id];
        });
        // $regional_offices = $regional_offices->merge(collect([(object)['name'=>'Warehouses','id'=>999]]));
        
        return view("cms.google_maps.edit", compact('google_map','regional_offices'));
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
        $GoogleMap = GoogleMap::find($id);

        if($GoogleMap->office_id == $request->office_id){
            $request->validate(GoogleMap::$rules_update);
        }else{
            $request->validate(GoogleMap::$rules);
        }

        $data = $request->all();
        $data['user_id']=Auth::user()->id;

        if($GoogleMap->update($data)){
            return redirect('cms/googlemaps')->with('status', 'success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $GoogleMap = GoogleMap::destroy($id);
        return redirect('cms/googlemaps');
    }

}
