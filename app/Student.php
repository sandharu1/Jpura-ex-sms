<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $table = 'student';
    protected $fillable = ['name', 'nic', 'reg_number', 'batch', 'res_tel', 'mobile_tel', 'email', 'address', 'std_pic_name'];
    
}
