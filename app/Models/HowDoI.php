<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class HowDoI extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait,Multilingual;
	use SluggableScopeHelpers;

	protected $table = 'how_do_i';

	protected $guarded=[];

  	protected $translatableAttributes = ['title','content'];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_en'
            ]
        ];
    }

	public static $rules = [
		'title_en' => 'required|max:191',
    	'title_sw' => 'required|max:191',
		'content_en' => 'required',
    	'content_sw' => 'required',
	];
	
}
