<?php
namespace App\Models;

use App\Traits\Multilingual;
use App\Traits\TrackableInterface;
use App\Traits\TrackableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Events extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait;
	use SluggableScopeHelpers,Multilingual;


	protected $table = "events";
	protected $guarded=[];

  protected $translatableAttributes = ['title','content'];

    // Add validation rules here
    public static $rules = [
         'event_date' => 'required',
         'event_time' => 'required | max: 18',
         'location' => 'required | max: 64',
         'contact' => 'required | max: 191',
         'title_en' => 'required|max:191',
         'title_sw' => 'required|max:191',
         'content_en' => 'required',
         'content_sw' => 'required',
         'active' => 'required',
         'photo_url' => 'required'
    ];

    //rules for updating
    public static $rules_update = [
         'event_date' => 'required',
         'event_time' => 'required | max: 18',
         'location' => 'required | max: 64',
         'contact' => 'required | max: 191',
         'title_en' => 'required|max:191',
         'title_sw' => 'required|max:191',
         'content_en' => 'required',
         'content_sw' => 'required',
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




	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

  

}
