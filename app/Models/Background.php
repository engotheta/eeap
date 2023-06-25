<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Background extends Model{

	protected $guarded=[];

	// Add your validation rules here
	public static $rules = [
		'main_bg' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      	// 'banner_bg' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
	];
	
	// Add your validation rules here for main bg only
	public static $rules_main_bg = [
		'main_bg' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
	];
	
	// Add your validation rules here for banner bg only
	public static $rules_banner_bg = [
      	'banner_bg' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
	];
	
	// Add your validation rules here for second bg only
	public static $rules_second_bg = [
      	'second_bg' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
	];

}
