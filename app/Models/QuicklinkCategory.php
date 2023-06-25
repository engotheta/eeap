<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class QuicklinkCategory extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	protected $guarded=[];


    protected $translatableAttributes = ['title', 'banner'];

	public static $rules = [
		'title_en' => 'required|max:191',
    	'title_sw' => 'required|max:191',
		'active' => ''
	];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_en'
            ]
        ];
    }


	public function quicklinks(){
		return $this->hasMany('App\Models\QuickLink', 'category_id');
	}

}
