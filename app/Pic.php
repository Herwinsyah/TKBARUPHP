<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $table = 'pic';
    protected $fillable = ['first_name','last_name','address','email']; 

    public function scopeFilter($query, $id)
    {
        return $query->where('pic_id', $id);
    }

    public function phone()
    {
    	return $this->belongsToMany('App\PhoneNumber');
    }
}
