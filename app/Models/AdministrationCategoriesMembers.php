<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class AdministrationCategoriesMembers extends Model implements TrackableInterface {

	use TrackableTrait,Multilingual;

	protected $table = 'administration_categories_members';
	protected $guarded=[];
	protected $translatableAttributes = ['title'];

	//protected $fillable = ['title', 'title_sw', 'slug', 'active'];

	public static $rules = [
		'member_id' => 'required',
		'category_id' => 'required',
		'title_en' => 'required | max:191',
		'title_sw' => 'required | max:191',
		'position' => 'required | numeric | min:1',
	];

	// public function administration(){
	// 	return $this->hasMany('App\Models\Administration', 'category_id');
	// }

	public function member(){
		return $this->belongsTo(Administration::class, 'member_id');
	}

	public function category(){
		return $this->belongsTo(AdministrationCategories::class, 'category_id');
	}

}
