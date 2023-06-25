<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\Multilingual;
use App\Traits\TrackableInterface;

class PressRelease extends Model implements TrackableInterface {

	use TrackableTrait;
	use Sluggable,SluggableScopeHelpers,Multilingual;

	protected $guarded=[];

	protected $translatableAttributes = ['name', 'content'];

	public static $rules = [
		'name_en' => 'required|max:191',
        'name_sw' => 'required|max:191',
		'file_en' => 'required|max:15360|mimes:pdf,doc,docx,odt,xls,xlsx',
		'file_sw' => 'required|max:15360|mimes:pdf,doc,docx,odt,xls,xlsx',
		'content_en' => 'required',
        'content_sw' => 'required',
		'active' => 'required'
	];

	public static $rules_update = [
		'name_en' => 'required|max:191',
        'name_sw' => 'required|max:191',
		'file_en' => 'max:15360|mimes:pdf,doc,docx,odt,xls,xlsx',
		'file_sw' => 'max:15360|mimes:pdf,doc,docx,odt,xls,xlsx',
		'content_en' => 'required',
        'content_sw' => 'required',
		'active' => 'required'
	];

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }


	// Don't forget to fill this array
	//protected $fillable = ['name', 'content', 'active','slug'];


}
