<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use Illuminate\Validation\Rule;

class GoogleMap extends Model implements TrackableInterface {

    use TrackableTrait;
    protected $table="google_maps";
    protected $guarded=[];
	
	// validation rules
	public static $rules = [
		// 'office_id' => 'required|exists:regional_offices,id|unique:google_maps,office_id',
		'office_id' => 'required|unique:google_maps,office_id',
		'url' => 'required'
	];
	
	// edit validation rules
	public static $rules_update = [
		// 'office_id' => 'required|exists:regional_offices,id',
		'office_id' => 'required',
		'url' => 'required'
	];

	public function office(){
		return $this->belongsTo('App\Models\RegionalOffice', 'office_id');
	}

}
