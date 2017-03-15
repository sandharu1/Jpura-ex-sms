<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perstage extends Model
{
	protected $table = 'perstage';
    protected $fillable = ['batch_id', 'stage_no', 'perModules', 'totcredits', 'academicYear'];

    public function batch(){
    	return $this->belongsTo('App\Batch', 'batch_id', 'batchID');
    }
}
