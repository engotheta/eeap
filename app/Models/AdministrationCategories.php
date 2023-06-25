<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class AdministrationCategories extends Model implements TrackableInterface {

	use Sluggable,SluggableScopeHelpers;
	use TrackableTrait,Multilingual;

	protected $table = 'administration_categories';
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

	//protected $fillable = ['title', 'title_sw', 'slug', 'active'];

	public static $rules = [
		'title_en' => 'required',
		'title_sw' => 'required',
	];

	// public function administration(){
	// 	return $this->hasMany('App\Models\Administration', 'category_id');
	// }

	public function category_members(){
		return $this->hasMany('App\Models\AdministrationCategoriesMembers', 'category_id');
	}

}
