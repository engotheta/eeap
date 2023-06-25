<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class LicensedEntityCategory extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	protected $guarded=[];


  protected $translatableAttributes = ['title','content'];

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


	public function licensedEntities(){
		return $this->hasMany('App\Models\LicensedEntity', 'category_id')->orderBy('created_at', 'DESC');
	}



}
