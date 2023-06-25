<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class WelcomeNote extends Model implements TrackableInterface{

	use TrackableTrait,Multilingual;

	protected $table = "welcome";

	protected $guarded=[];

  	protected $translatableAttributes = ['summary', 'content'];

	// Add your validation rules here
	public static $rules = [
		'content_en' => 'required',
      	'content_sw' => 'required',
		'summary_en' => '',
      	'summary_sw' => ''
	];

}
