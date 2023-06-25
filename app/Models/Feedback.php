<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TrackableTrait;
use App\Traits\TrackableInterface;
use App\Traits\Multilingual;

class Feedback extends Model {
  protected $table  = 'feedbacks';
	protected $guarded=[];

}
