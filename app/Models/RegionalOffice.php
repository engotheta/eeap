<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class RegionalOffice extends Model implements TrackableInterface{

    use Sluggable,TrackableTrait,Multilingual;
    use SluggableScopeHelpers;

    protected $table = 'regional_offices';

    protected $guarded=[];

    protected $translatableAttributes = ['physical_address', 'content', 'name'];

    public static $rules = [
        'name_en' => 'required|max:191',
        'name_sw' => 'required|max:191',
        'physical_address_en' => 'required',
        'physical_address_sw' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }

    public function maps(){
		return $this->hasOne('App\Models\GoogleMap', 'office_id')->orderBy('id', 'DESC');
	}

}
