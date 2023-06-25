<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\Multilingual;
use App\Traits\TrackableInterface;

class QuickInfo extends Model implements TrackableInterface {

	use TrackableTrait;
	use Sluggable,SluggableScopeHelpers,Multilingual;

	protected $guarded=[];

	protected $translatableAttributes = ['info', 'content'];

	public static $rules = [
		'info_en'   => 'required|max:191',
        'info_sw'   => 'required|max:191',
		'active' => 'required'
	];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'info_en'
            ]
        ];
    }

}
