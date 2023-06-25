<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Administration extends Model implements TrackableInterface {

	use Sluggable,SluggableScopeHelpers;
	use TrackableTrait,Multilingual;

	protected $guarded=[];
	protected $table='administration_members';
	protected $translatableAttributes = ['title','content'];
	//protected $fillable = ['fullname','title_en','title_sw','content_en','content_sw','photo_url','category_id', 'user_id','position'];


	public static $rules = [
	'fullname' => 'required',
	'title_en' => 'required|max:190',
	'title_sw' => 'required|max:190',
	'photo_url' => 'required'
	];

	public function sluggable(): array
	{
			return [
					'slug' => [
							'source' => 'fullname'
					]
			];
	}

	// public function category(){
	// 	return $this->belongsTo('App\Models\AdministrationCategories', 'category_id');
	// }

	// public function group(){
	// 	return $this->belongsTo(ManagementGroup::class, 'group_id');
	// }
	
	// public static function category_name($id){
	// 	return AdministrationCategories::where('id',$id)->first()->title_en;
	// }

	public function member_categories(){
		return $this->hasMany('App\Models\AdministrationCategoriesMembers', 'member_id');
	}

}
