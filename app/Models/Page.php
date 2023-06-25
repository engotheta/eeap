<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Page extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	// validation rules
	public static $rules = [
		'title_en' => 'required|max:191',
		'title_sw' => 'required|max:191',
		'has_sidebar' => 'required',
		'content_en' => 'required',
		'content_sw' => 'required'
	
//		'page_category_id' => 'required', //video or audio or photo
	];

	//fillables
	protected $guarded=[];

    protected $translatableAttributes = ['title','content','banner'];


  public function sluggable(): array {
      return [
          'slug' => [
              'source' => 'title_en'
          ]
      ];
  }

	public function category(){
		return $this->belongsTo('App\Models\Page_category');
	 }

}
