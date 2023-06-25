<?php namespace App\Models;
use App\Traits\ElasticSearchTrait;
use App\Traits\ElasticSearchInterface;

class Search extends \Eloquent implements ElasticSearchInterface{
	use ElasticSearchTrait;
	public static $rules = [
		'q' => 'required',
		'page' => 'numeric',
	];



}