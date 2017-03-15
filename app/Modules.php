<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
	protected $table = 'module';
	protected $fillable = ['id', 'name', 'module_id', 'programID', 'credits', 'year_commenced', 'created_at', 'updated_at'];

	public function course(){
		return $this->belongsTo('App\Courses');
	}
	public function marks(){
		return $this->hasMany('App\Marks', 'moduleID', 'module_id');
	}
}
