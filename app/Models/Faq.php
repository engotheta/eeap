<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Faq extends Model implements TrackableInterface {

    use Sluggable,TrackableTrait;
	use SluggableScopeHelpers,Multilingual;


	// validation rules
	public static $rules = [
		'question_en' => 'required|max:191',
		'question_sw' => 'required|max:191',
		'answer_en' => 'required',
		'answer_sw' => 'required',
	];

	protected $guarded=[];

	protected $translatableAttributes = ['question', 'answer'];
	// strong parameters support array
	//protected $fillable = ['question_en', 'question_sw', 'answer_en', 'answer_sw', 'user_id'];
	protected $indexable = ['question', 'answer'];
	protected $urlPrefix = 'faqs';

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'question_en'
            ]
        ];
    }

}
