<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseModuleMarks extends Model
{
    protected $table = 'program';
    protected $fillable = ['id', 'name', 'program_id', 'credits', 'year_commenced', 'created_at'];

}
