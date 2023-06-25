<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model {

	protected $table = "timelines";

	protected $fillable = ['actor', 'verb', 'object', 'content', 'ip', 'url'];

	public function user(){
		return $this->belongsTo('App\Models\User', 'actor', 'id');
	}

}
