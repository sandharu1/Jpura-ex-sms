<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    protected $table = 'module_marks';
    protected $fillable = ['id', 'nic', 'student_id', 'moduleID', 'mark', 'attempt', 'grade', 'credit', 'gpa', 'year', 'created_at', 'updated_at'];

    public function module(){
    	return $this->belongsTo('App\Modules', 'moduleID', 'module_id');
    }
}
