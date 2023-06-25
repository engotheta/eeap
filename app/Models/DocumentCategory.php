<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class DocumentCategory extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	protected $guarded=[];


    protected $translatableAttributes = ['title','banner'];

	public static $rules = [
		'title_en' => 'required|max:191',
    	'title_sw' => 'required|max:191',
		'banner_en' => 'max:300',
		'banner_sw' => 'max:300',
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


	public function documents(){
		return $this->hasMany('App\Models\Documents', 'category_id')->orderBy('published_date', 'DESC');
	}

	public function documents_limit(){
		return $this->hasMany('App\Models\Documents', 'category_id')->orderBy('published_date', 'DESC')->limit(10);
	}

}
