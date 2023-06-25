<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\Multilingual;
use App\Traits\TrackableInterface;

class LicensedEntity extends Model implements TrackableInterface {

	use TrackableTrait;
	use Sluggable,SluggableScopeHelpers,Multilingual;

	protected $guarded=[];

//	protected $translatableAttributes = ['name', 'content'];


	public static $rules = [
		'name'   => 'required|max:191',
		'principal_officer'   => 'required|max:191',
		// 'address' => 'required',
		'category_id' => 'required',
	];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


	// Don't forget to fill this array
	//protected $fillable = ['name', 'content', 'active','slug'];

    public function category(){
		return $this->belongsTo('App\Models\LicensedEntityCategory', 'category_id');
	}


}
