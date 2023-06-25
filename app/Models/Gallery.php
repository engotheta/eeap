<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

use DB;
class Gallery extends Model implements TrackableInterface {

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;


	protected $guarded=[];

	protected $translatableAttributes = ['title', 'content'];

	// validation rules
	public static $rules = [
		'title_en' => 'required',
		'title_sw' => 'required',
		'featured' => '',
		'type' => 'required', //video or audio or photo
//		'iconurl' => 'mimes:jpg,png,jpeg,bmp|max:2000', //if icon is needed
	];

	//fillables
	//protected $fillable = ['title_en', 'title_sw', 'content_en', 'content_sw', 'type','category', 'iconurl','status','slug','featured'];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_en'
            ]
        ];
    }


	public function videos(){
		return $this->hasMany('App\Models\Video', 'gallery_id', 'id')->orderBy('created_at', 'DESC');

	 }
     public function medias(){
		return $this->hasMany('App\Models\Photo', 'gallery_id', 'id')->orderBy('created_at', 'DESC');
	 }


	public function photos(){
		return $this->hasMany('App\Models\Photo','gallery_id', 'id')->orderBy('created_at', 'DESC');

	 }

	 public static function boot() {

	    parent::boot();
		  static::deleting(function($gallery) {

		    	if(!$gallery->photos->count()){
		    		return true;
		    	}
		    	if(!$gallery->videos->count()){
		    		return true;
		    	}
		    	return false;
		    });

	}
	    public static function getVideos()
    {

       //echo json_encode($videos);
      // die();
        return view('site.galleries.index', compact('videos'));
    }

    public static function get_gallery_visit(){
    	$galleries = Gallery::where('category','=',1)->orderBy('id', 'DESC')->get();
    	return $galleries;
    }

}
