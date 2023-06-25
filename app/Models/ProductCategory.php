<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class ProductCategory extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	protected $guarded=[];


    protected $translatableAttributes = ['title', 'summary'];

	public static $rules = [
		'title_en' => 'required|max:191',
    	'title_sw' => 'required|max:191',
		'summary_en' => 'required',
		'summary_sw' => 'required',
		'photo_url' => 'required',
		'active' => 'required'
	];


	public static $rules_update = [
		'title_en' => 'required|max:191',
    	'title_sw' => 'required|max:191',
		'summary_en' => 'required',
		'summary_sw' => 'required',
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

	public function products(){
		return $this->hasMany('App\Models\Product', 'category_id')->orderBy('id', 'DESC');
	}

}
