<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
	protected $table = 'batch';
	protected $fillable = ['batchID', 'batchName', 'programID', 'yearCommenced', 'noStages'];

	public function course(){
		return $this->belongsTo('App\Courses', 'programID', 'program_id');
	}
	public function student(){
		return $this->hasMany('App\Student', 'batch', 'batchID');
	}
	public function perstage(){
		return $this->hasMany('App\Perstage', 'batch_id', 'batchID');
	}
}
