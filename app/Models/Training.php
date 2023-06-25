<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\Multilingual;
use App\Traits\TrackableInterface;

class Training extends Model implements TrackableInterface {

	use TrackableTrait;
	use Sluggable,SluggableScopeHelpers,Multilingual;

	protected $guarded=[];

	protected $translatableAttributes = ['name', 'content'];

	public static $rules = [
		'title_en'   => 'required|max:191',
        'title_sw'   => 'required|max:191',
        'content_en' => 'required',
        'content_sw' => 'required',
        // 'start_date' => 'required',
        // 'end_date' => 'required',
        // 'file_en' => 'required',
        // 'file_sw' => 'required',
	];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_en'
            ]
        ];
    }



	// Don't forget to fill this array
	//protected $fillable = ['name', 'content', 'active','slug'];


}
