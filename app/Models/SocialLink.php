<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;
class SocialLink extends Model implements  TrackableInterface  {
	use TrackableTrait,Multilingual;
	protected $fillable = ['title_en', 'url'];

	public static $rules = [
		 'title_en' => 'required',
		 'url' => 'required'
	];


}
