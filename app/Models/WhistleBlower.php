<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhistleBlower extends Model {

	protected $fillable = ['title_en', 'title_sw','url', 'active','link','url_external','parent','position'];

	protected $translatableAttributes = ['title'];

	public static $rules = [
		'fullname'	=> 'nullable|max:191',
		'email'	=> 'nullable|email|max:191',
		'phone'	=> 'nullable|max:25',
		'incident_location' => 'required|max:255',
		'incident_description' => 'required|max:10240',
		'incident_extra_info' => 'nullable|max:255',
		'attachment' => 'nullable|max:1024|mimes:pdf,jpg,jpeg,png',
		'g-recaptcha-response' => 'required',
	];

}