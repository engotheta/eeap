<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Video extends Model implements  TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	protected $table ='media';

	// validation rules
	public static $rules = [
		// 'title_en' => 'required',
		// 'title_sw' => 'required',
		'url' => '',
		'gallery_id' => 'required',
		//'type' => 'required', //video or audio or photo
		//'iconurl' => 'mimes:jpg,png,jpeg,bmp|max:2000', //if icon is needed
	];

	//fillables
	// protected $fillable = ['title_en', 'title_sw'];

	protected $translatableAttributes = ['title'];
	protected $guarded=[];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_en'
            ]
        ];
    }

	public function gallery(){
		return $this->belongsTo('App\Models\Gallery');
	}

}
