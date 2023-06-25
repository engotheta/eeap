<?php namespace App\Traits;

use App\Models\Timeline;
use Auth;
use Request;
use Route;

trait TrackableTrait{

	public static function boot()
    {
        parent::boot();

		static::saving(function($item){
			$item->keepTrack($item);
		});		
				
		static::deleting(function($item){
			$item->keepTrack($item);
		});
	}

	public function keepTrack($item){

		$trackableItem = [];

		$obj = explode("\\", get_class($item));
		$obj = last($obj);
		$trackableItem['object'] = $obj;

		$verb = explode("@", Route::currentRouteAction());
		$verb = last($verb);
		$trackableItem['verb'] = $verb;

		$trackableItem['actor'] = (Auth::user())?Auth::user()->id:0;
		$trackableItem['content'] = json_encode($item);
		$trackableItem['url'] = Request::url();
		$trackableItem['ip'] = Request::ip();

		Timeline::create($trackableItem);
	}

}