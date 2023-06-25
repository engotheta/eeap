<?php
namespace App\Models;

use App\Traits\Multilingual;
use App\Traits\TrackableInterface;
use App\Traits\TrackableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model implements TrackableInterface{

	use Sluggable,TrackableTrait;
	use SluggableScopeHelpers,Multilingual;

	protected $table = "partners";
	protected $guarded=[];


    protected $translatableAttributes = [ 'content','title'];

    // Add your validation rules here
    public static $rules = [
         'title_en' => 'required',
         'title_sw' => 'required',
         'position' => 'required',
        //  'content_en' => 'required',
        //  'content_sw' => 'required',
         'active' => 'required',
         'photo_url' => 'required'
    ];

    public static $edited_rules = [
         'title_en' => 'required',
         'title_sw' => 'required',
        //  'content_en' => 'required',
        //  'content_sw' => 'required',
         'active' => 'required',
    ];

	//protected static $logUnguarded = true;

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }




	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

//    public function getTitleEnAttribute($value)
//    {
//        return __($this->title_translation, [], 'en');
//    }

}
