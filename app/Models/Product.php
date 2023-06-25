<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Product extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	protected $guarded=[];


    protected $translatableAttributes = ['title', 'summary', 'content'];

	public static $rules = [
		'title_en' => 'required|max:191',
    	'title_sw' => 'required|max:191',
    	'price' => 'required|max:191',
		// 'summary_en' => 'required',
		// 'summary_sw' => 'required',
		'content_en' => '',
		'content_sw' => '',
		// 'photo_url' => 'required',
		'category_id' => 'required|exists:App\Models\ProductCategory,id',
		'active' => 'required'
	];


	public static $rules_update = [
		'title_en' => 'required|max:191',
    	'title_sw' => 'required|max:191',
		'summary_en' => 'required',
		'summary_sw' => 'required',
		'content_en' => '',
		'content_sw' => '',
		'category_id' => 'required',
		'active' => 'required'
	];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_en'
            ]
        ];
    }

	public function category(){
		return $this->belongsTo('App\Models\ProductCategory', 'category_id');
	}

}
