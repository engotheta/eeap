<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Page_category extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	// validation rules
	public static $rules = [
		'title_en' => 'required|max:191',
		'title_sw' => 'required|max:191',
		'slug' => '',
	];

	//fillables
	//protected $fillable = ['title', 'title', 'status','slug','modifiable'];
	protected $guarded=[];

	protected $translatableAttributes = ['title'];

	 public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_en'
            ]
        ];
    }

//model events
	 // public static function boot($events) {
	 public static function boot() {

	    parent::boot();


	  static::deleting(function($category) {

	    	if($category->modifiable){
	    		return true;
	    	}
	    	if($category->modifiable && !$category->pages->count()){
	    		return true;
	    	}
	    	return false;
	    });

	}


	public function pages(){
		return $this->hasMany('App\Models\Page');

	 }


}
