<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'program';
    protected $fillable = ['id', 'name', 'program_id', 'credits', 'year_commenced', 'created_at'];

    public function module(){
    	return $this->hasMany('App\Modules');
    }
     public function batch(){
    	return $this->hasMany('App\Batch', 'programID', 'program_id');
    }
}
